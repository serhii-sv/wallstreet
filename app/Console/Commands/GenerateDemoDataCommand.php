<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Console\Commands;

use App\Jobs\GenerateDemoForUserJob;
use App\Models\Currency;
use App\Models\Deposit;
use App\Models\Faq;
use App\Models\Language;
use App\Models\News;
use App\Models\NewsLang;
use App\Models\PaymentSystem;
use App\Models\Rate;
use App\Models\Referral;
use App\Models\Reviews;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Console\Command;
use Faker\Factory;
use Illuminate\Support\Carbon;

/**
 * Class GenerateDemoDataCommand
 * @package App\Console\Commands
 */
class GenerateDemoDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:demo_data {stressLevel?} {onlyUsers?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate demo data for the project';

    /** @var Factory */
    private $faker;

    /** @var int */
    private $stressLevel;

    /** @var int */
    private $onlyUsers;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->faker = Factory::create();
    }

    /**
     * @throws \Exception
     */
    public function handle()
    {
        $this->stressLevel = (int) $this->argument('stressLevel');
        $this->onlyUsers = (int) $this->argument('onlyUsers');

        if ($this->stressLevel <= 0) {
            $this->stressLevel = 1;
        }

        if (0 == $this->onlyUsers) {
            $this->comment('Generating news');
            $this->generateNews();
            $this->comment('News generated');

            $this->comment('Generating faqs');
            $this->generateFaqs();
            $this->comment('Faqs generated');

            $this->comment('Generating reviews');
            $this->generateReviews();
            $this->comment('Reviews generated');

            $this->comment('Generating referral levels');
            $this->generateReferralLevels();
            $this->comment('Referral levels generated');

            $this->comment('Generating rates');
            $this->generateRates();
            $this->comment('Rates generated');

            $this->comment('Generating settings');
            $this->generateSettings();
            $this->comment('Settings generated');

//            $this->comment('Generating transactions');
//            $this->generateTransactions();
//            $this->comment('Transactions generated');
        }

        $this->comment('Generating users');
        $this->generateUsers();
        $this->comment('Users generated');
    }

    private function generateNews()
    {
        $languages = Language::select('id')->get();

        if ($languages->count() == 0) {
            $this->warn('Languages not found for NEWS');
            return;
        }

        for ($newsCount = 1; $newsCount <= 15; $newsCount++) {
            $newNews = [
                'slug'       => $this->faker->word . ' ' . $this->faker->word,
                'created_at' => $this->faker->dateTimeThisYear()->format('Y-m-d').' 12:00:00',
            ];

            if (News::where('slug', $newNews['slug'])->count() == 0) {
                $createdNews = News::create($newNews);
                $this->info('news created with slug "' . $newNews['slug'] . '"');
            }

            foreach ($languages as $language) {
                $newsLangs = [
                    'news_id'    => $createdNews->id,
                    'lang_id'    => $language->id,
                    'show'       => $this->faker->numberBetween(0, 1),
                    'title'      => $this->faker->word . ' ' . $this->faker->word . ' ' . $this->faker->word,
                    'teaser'     => $this->faker->text,
                    'text'       => $this->faker->text . ' ' . $this->faker->text,
                    'created_at' => $this->faker->dateTimeThisYear()->format('Y-m-d').' 12:00:00',
                ];

                NewsLang::create($newsLangs);
                $this->info('news with lang ' . $language->code . ' created with title "' . $newsLangs['title'] . '"');
            }
        }
    }

    private function generateTransactions(){
        $transactionTypeIds = TransactionType::all()->map(function($tr){
            return $tr->id;
        });

        $userIds = User::all()->map(function ($u) {
            return $u->id;
        });

        $currencyIds = Currency::all()->map(function($c){
            return $c->id;
        });

        $rateIds = Rate::all()->map(function($r){
            return $r->id;
        });

        $depositIds = Deposit::all()->map(function($d){
           return $d->id;
        });

        $walletIds = Wallet::all()->map(function($w){
            return $w->id;
        });

        $paymentSystemIds = PaymentSystem::all()->map(function($p){
            return $p->id;
        });

        for($i = 0; $i < 50; $i++){

            Transaction::create([
                'type_id' =>    $transactionTypeIds->get(rand(0,8)),
                'user_id' =>    $userIds->get(rand(0, count($userIds) - 1)),
                'currency_id' => $currencyIds->get(rand(0, count($currencyIds) - 1)),
                'rate_id' => $rateIds->get(rand(0, count($rateIds) - 1)),
                'deposit_id' => $depositIds->get(rand(0, count($depositIds) - 1)),
                'wallet_id' => $walletIds->get(rand(0, count($walletIds) - 1)),
                'payment_system_id' => $paymentSystemIds->get(rand(0, count($paymentSystemIds) - 1)),
                'amount' => rand(200, 1000),
                'approved' => rand(0,1),
                'created_at' => Carbon::today()->subDays(rand(0, 2))
            ]);
        }
    }

    public function generateFaqs()
    {
        for ($faqsCount = 1; $faqsCount <= 25; $faqsCount++) {
            /** @var Language $lang */
            $lang = Language::select('id')
                ->inRandomOrder()
                ->limit(1)
                ->first();

            if (empty($lang)) {
                $this->warn('Language not found for FAQ');
                return;
            }

            $newFaq = [
                'lang_id'    => $lang->id,
                'title'      => $this->faker->word,
                'text'       => $this->faker->text,
                'created_at' => $this->faker->dateTimeThisYear()->format('Y-m-d').' 12:00:00',
            ];

            Faq::create($newFaq);
            $this->info('FAQ was created with title "' . $newFaq['title'] . '" and lang ' . $lang['code']);
        }
    }

    public function generateReviews()
    {
        for ($reviewsCount = 1; $reviewsCount <= 50; $reviewsCount++) {
            $lang = Language::select('id')
                ->inRandomOrder()
                ->limit(1)
                ->first();

            if (empty($lang)) {
                $this->warn('Language not found for REVIEW');
                return;
            }

            $newReview = [
                'lang_id'    => $lang->id,
                'name'       => $this->faker->name,
                'text'       => $this->faker->text,
                'video'      => $this->faker->boolean ? $this->faker->url : null,
                'created_at' => $this->faker->dateTimeThisYear()->format('Y-m-d').' 12:00:00',
            ];

            Reviews::create($newReview);
            $this->info('customer reviews created with user name ' . $newReview['name']);
        }
    }

    public function generateReferralLevels()
    {
        for ($level = 1; $level <= $this->faker->numberBetween(3, 10); $level++) {
            Referral::create([
                'level'         => $level,
                'percent'       => $this->faker->numberBetween(1, 10),
                'on_load'       => 1,
                'on_profit'     => $this->faker->numberBetween(0, 1),
                'on_task'       => $this->faker->numberBetween(0, 1),
            ]);
            $this->info('level ' . $level . ' registered');
        }
    }

    public function generateRates()
    {
        for ($ratesCount = 1; $ratesCount <= 3; $ratesCount++) {
            $randomCurrency = Currency::select('id')
                ->inRandomOrder()
                ->limit(1)
                ->first();

            if (null === $randomCurrency) {
                $this->warn('can not generate rates, because currencies is not registered.');
                break;
            }

            $min = $this->faker->numberBetween(5, 20);
            $max = $ratesCount * $this->faker->numberBetween(50, 400);

            $newRate = [
                'currency_id' => $randomCurrency->id,
                'name'        => 'plan ' . $this->faker->domainWord,
                'min'         => $ratesCount == 1
                    ? $min
                    : $ratesCount * $min,
                'max'         => $ratesCount == 1
                    ? $max
                    : $ratesCount * $max,
                'daily'       => $this->faker->numberBetween(1, 5),
                'overall'     => $this->faker->numberBetween(0, 50),
                'duration'    => $this->faker->numberBetween(3, 6),
                'payout'      => $this->faker->numberBetween(90, 100),
                'reinvest'    => $this->faker->numberBetween(0, 1),
                'autoclose'   => $this->faker->numberBetween(0, 1),
                'active'      => $ratesCount == 3 ? 0 : 1,
            ];

            Rate::create($newRate);
            $this->info('rate ' . $newRate['name'] . ' registered');
        }
    }

    public function generateSettings()
    {
        Setting::setValue('phone', $this->faker->phoneNumber);
        Setting::setValue('email', $this->faker->email);
        Setting::setValue('telegram', '@'.$this->faker->word);
        Setting::setValue('whatsapp', $this->faker->phoneNumber);
        Setting::setValue('company_name', $this->faker->company);
        Setting::setValue('address', $this->faker->address);
        Setting::setValue('working_time', '09:00 - 18:00 UTC 0');
    }

    public function generateUsers()
    {
        $this->faker = Factory::create();

        for ($usersCount = 1; $usersCount <= $this->faker->numberBetween(50,100)*$this->stressLevel; $usersCount++) {
            $partnerId = User::select('my_id')
                ->inRandomOrder()
                ->limit(1)
                ->first();

            $newUser = [
                'name'       => $this->faker->name,
                'email'      => $this->faker->email,
                'login'      => $this->faker->word . '.' . $this->faker->word,
                'password'   => bcrypt($this->faker->password),
                'partner_id' => !empty($partnerId) ? $partnerId->my_id : null,
                'created_at' => $this->faker->dateTimeThisYear()->format('Y-m-d').' 12:00:00',
            ];

            $checkExists = User::where('login', $newUser['login'])
                ->orWhere('email', $newUser['email'])
                ->get()
                ->count();

            if ($checkExists > 0) {
                continue;
            }

            $user = User::create($newUser);
            GenerateDemoForUserJob::dispatch($user, $this->stressLevel)->delay(0);
            $this->info('user ' . $newUser['name'] . ' registered');
        }
    }
}
