<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Console\Commands;

use App\Models\Currency;
use App\Models\Deposit;
use App\Models\Faq;
use App\Models\Language;
use App\Models\News;
use App\Models\PaymentSystem;
use App\Models\Rate;
use App\Models\RateGroup;
use App\Models\Referral;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Faker\Factory;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GenerateDemoDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:demo_data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate demo data for the project';

    /** @var Factory */
    private $faker;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();

        /** @var Factory */
        $this->faker = Factory::create();
    }

    /**
     * @throws \Exception
     */
    public function handle() {
        $this->comment('Reg program creating');
        $this->generateReferralLevels();

        $this->comment('Rates creating');
        $this->generateRates();

        $this->comment('Settings creating');
        $this->generateSettings();

        try {
            $this->comment('Rates');
            $this->call('update:currency_rates');
        } catch (\Exception $e) {
            $this->warn('can not update currency rates');
        }

        $this->comment('Users creating');
        $this->generateUsers();

        $this->comment('News creating');
        $this->generateNews();

        $this->comment('FAQ creating');
        $this->generateFaq();

        $this->comment('Sprint Token rate change creating');
        $this->generateSprintTokenRateLog();
    }

    public function generateReferralLevels() {
        for ($level = 1; $level <= $this->faker->numberBetween(1, 2); $level++) {
            Referral::updateOrCreate([
                'level' => $level,
            ], [
                'level' => $level,
                'percent' => $this->faker->numberBetween(1, 10),
                'on_load' => 1,
                'on_profit' => $this->faker->numberBetween(0, 1),
            ]);
            $this->info('level ' . $level . ' registered');
        }
    }

    public function generateRates() {
        /** @var Currency $currencies */
        // $currencies = Currency::all();
        $rate_groups = RateGroup::all();
        $rate_count_in_group = 4;
        $count = 1;

        /** @var Currency $currency */
        foreach ($rate_groups as $group) {
            for ($i = 1; $i <= $rate_count_in_group; $i++) {

                $min = $this->faker->numberBetween(5, 20);
                $max = $count * $this->faker->numberBetween(50, 400);
                $group->refund_deposit ? $overall = 0 : $overall = $this->faker->numberBetween(100, 200) * $this->faker->numberBetween(0, 1);

                $newRate = [
                    //'currency_id' => $currency->id,
                    'name' => 'rate ' . $this->faker->domainWord,
                    'min' => $count == 1 ? $min : $count * $min,
                    'max' => $count == 1 ? $max : $count * $max,
                    'daily' => $this->faker->numberBetween(1, 5),
                    'overall' => $overall,
                    'duration' => $this->faker->numberBetween(3, 6),
                    'payout' => $this->faker->numberBetween(90, 100),
                    'reinvest' => $this->faker->numberBetween(0, 1),
                    'autoclose' => $this->faker->boolean(80),
                    'active' => $this->faker->boolean(100),
                    'rate_group_id' => $group->id,
                ];

                /** @var Rate $rate */
                $rate = Rate::create($newRate);
                $this->info('rate ' . $rate->name . ' registered');

                $count++;
            }
        }
    }

    public function generateSettings() {
        Setting::setValue('phone', $this->faker->phoneNumber);
        Setting::setValue('email', $this->faker->email);
        Setting::setValue('whatsapp', $this->faker->phoneNumber);
        Setting::setValue('company_name', $this->faker->company);
        Setting::setValue('address', $this->faker->address);
        Setting::setValue('working_time', '09:00 AM - 06:00 PM');
    }

    public function generateUsers() {
        for ($usersCount = 1; $usersCount <= 15; $usersCount++) {
            $partner = User::inRandomOrder()->limit(1)->first();

            $newUser = [
                'name' => $this->faker->name,
                'email' => $this->faker->email,
                'login' => $this->faker->word . '.' . $this->faker->word,
                'unhashed_password' => 'demopassword',
                'api_token' => Str::random(60),
                'password' => bcrypt('demopassword'),
                'partner_id' => !empty($partner) ? $partner->my_id : null,
                'created_at' => $this->faker->dateTimeThisMonth()->format('Y-m-d') . ' 12:00:00',
            ];

            $checkExists = User::where('login', $newUser['login'])->orWhere('email', $newUser['email'])->get()->count();

            if ($checkExists > 0) {
                $this->warn('found user with same login or email, skipping.');
                continue;
            }

            $user = null;

            DB::transaction(function () use ($newUser, &$user, $partner) {
                /** @var User $user */
                $user = User::create($newUser);
                $this->generateBalances($user);
//                $this->generateWalletDetails($user);
                //                $this->generateReferrals($user);
                $this->generateDeposits($user);
                $this->generateWithdrawals($user);

                $partner->referrals()->attach($user->id);
            });

            $this->info('user ' . $user->name . ' registered');
        }
    }

    /**
     * @param User $user
     *
     * @throws \Throwable
     */
    public function generateBalances(User $user) {
        $transactionType = TransactionType::getByName('enter');
        /** @var Wallet $wallet */
        foreach ($user->wallets()->get() as $wallet) {
            $payment_systems = $wallet->currency->paymentSystems()->get();
            foreach ($payment_systems as $payment_system) {
                for ($i = 1; $i <= 3; $i++) {
                    $amount = $this->faker->numberBetween(10, 1000);

                    $externalWallet = 'W' . $this->faker->randomNumber(5);

                    $transactionData = [
                        'amount' => $amount,
                        'type_id' => $transactionType->id,
                        'user_id' => $wallet->user_id,
                        'wallet_id' => $wallet->id,
                        'payment_system_id' => $payment_system->id,
                        'currency_id' => $wallet->currency_id,
                        'result' => 'completed',
                        'batch_id' => 'B' . $this->faker->randomNumber(5),
                        'approved' => $this->faker->boolean,
                        'log' => $this->faker->text,
                        'created_at' => $this->faker->dateTimeThisMonth()->format('Y-m-d') . ' 12:00:00',
                    ];

                    /** @var Transaction $transaction */
                    $transaction = Transaction::create($transactionData);
                    $wallet->refill($transaction->amount);

                    dump('balance updated ' . $wallet->id);
                }
            }
        }
    }
    /**
     * @param User $user
     *
     * @throws \Exception
     */
    public function generateWithdrawals(User $user) {
        $wallets = Wallet::where('user_id', $user->id)->where('balance', '>', 10)->inRandomOrder();

        if (0 === $wallets->count()) {
            return;
        }

        /** @var Wallet $wallet */
        foreach ($wallets->get() as $wallet) {
            $payment_systems = $wallet->currency->paymentSystems()->get();
            for ($i = 0; $i < 5; $i++) {
                $amount = $wallet->balance / 10;

                if (!$payment_systems->isEmpty()) {
                    $payment_system = $payment_systems->random(1)->first();
                } else {
                    return;
                }

                /** @var Transaction $transaction */
                $transaction = Transaction::withdraw($wallet, $amount, $payment_system);

                if (null !== $transaction && $this->faker->boolean) {
                    $transaction->created_at = $this->faker->dateTimeThisMonth('now')->format('Y-m-d') . ' 12:00:00';
                    $transaction->approved = 1;
                    $transaction->save();
                }

                dump('withdrawals created ' . $wallet->id);
            }
        }
    }

    /**
     * @param User $user
     *
     */
    public function generateDeposits(User $user) {
        /** @var Rate $randomRates */
        $randomRates = Rate::where('active', 1)->inRandomOrder()->get();

        if (null === $randomRates) {
            return;
        }
        $payment_systems = PaymentSystem::all();
        $currencies = Currency::all();
        /** @var Rate $randomRate */
        foreach ($currencies as $currency) {
            foreach ($randomRates as $randomRate) {
                $wallet = $user->wallets()->where('currency_id', $currency->id)->first();

                if (null === $wallet) {
                    return;
                }
                $enterTransaction = TransactionType::getByName('enter');
                $externalWallet = 'W' . $this->faker->randomNumber(5);
                $transactionData = [
                    'amount' => $randomRate->max,
                    'type_id' => $enterTransaction->id,
                    'user_id' => $wallet->user_id,
                    'wallet_id' => $wallet->id,
                    'currency_id' => $currency->id,
                    'payment_system_id' => $payment_systems->random(1)->first()->id,
                    'result' => 'completed',
                    'batch_id' => 'B' . $this->faker->randomNumber(5),
                    'approved' => $this->faker->boolean,
                    'log' => $this->faker->text,
                    'created_at' => $this->faker->dateTimeThisMonth()->format('Y-m-d') . ' 12:00:00',
                ];
                $wallet->refill($transactionData['amount']);

                /** @var Transaction $transaction */
                $transaction = Transaction::create($transactionData);

                $min = $randomRate->min == 0 ? 1 : $randomRate->min;
                $depositAmount = $this->faker->numberBetween($min, $randomRate->max);
                $depositData = [
                    'wallet_id' => $wallet->id,
                    'currency_id' => $currency->id,
                    'rate_id' => $randomRate->id,
                    'amount' => $depositAmount,
                    'active' => $this->faker->boolean,
                    'reinvest' => $randomRate->reinvest ? $this->faker->numberBetween(0, 20) : 0,
                    'created_at' => $this->faker->dateTimeThisMonth()->format('Y-m-d') . ' 12:00:00',
                    'user' => $wallet->user()->first(),
                ];

                /** @var Deposit $deposit */
                $deposit = Deposit::addDeposit($depositData, $currency, true);

                dump('deposit created ' . $deposit->id);
            }
        }
    }

    public function generateNews() {
        for ($i = 0; $i < 10; $i++) {
            $defaultLanguage = Language::getDefault()->code;
            $data = [
                'title' => [
                    $defaultLanguage => $this->faker->sentence(10),
                ],
                'short_content' => [
                    $defaultLanguage => $this->faker->sentence(50),
                ],
                'content' => [
                    $defaultLanguage => $this->faker->sentence(1000),
                ],
            ];

            News::create($data);
            $this->comment('news ' . $data['title'][$defaultLanguage] . ' generated');
        }
    }

    public function generateFaq() {
        for ($i = 0; $i < 10; $i++) {
            $data = [
                'question' => $this->faker->text,
                'answer' => $this->faker->text,
                'created_at' => $this->faker->dateTimeThisMonth()->format('Y-m-d') . ' 12:00:00',
            ];

            Faq::create($data);
            $this->comment('faq ' . $data['question'] . ' generated');
        }
    }

    public function generateSprintTokenRateLog() {
        Artisan::call('rate_log:generate');
    }
}
