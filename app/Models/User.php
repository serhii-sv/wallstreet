<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Models;

use App\Console\Commands\Automatic\ScriptCheckerCommand;
use App\Http\Controllers\Auth\LoginController;
use App\Jobs\TelegramNotificationJob;
use App\Mail\NotificationMail;
use App\Models\Telegram\TelegramBots;
use App\Models\Telegram\TelegramUsers;
use App\Models\UserTasks\UserTaskActions;
use App\Models\UserTasks\UserTaskPropositions;
use App\Models\UserTasks\UserTasks;
use App\Models\Youtube\YoutubeVideoWatch;
use App\Traits\Uuids;
use Carbon\Carbon;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Lab404\Impersonate\Models\Impersonate;
use Spatie\Permission\Traits\HasRoles;
use Webpatser\Uuid\Uuid;

/**
 * Class User
 * @package App\Models
 *
 * @property string id
 * @property string name
 * @property string email
 * @property string login
 * @property string password
 * @property string phone
 * @property string partner_id
 * @property string my_id
 * @property string remember_token
 * @property string tfa_token
 * @property bool tiketit_admin
 * @property bool tiketit_agent
 * @property string blockio_wallet_btc
 * @property string blockio_wallet_ltc
 * @property string blockio_wallet_doge
 * @property string sex
 * @property string country
 * @property string city
 * @property float latitude
 * @property float longitude
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon email_verified_at
 * @property Carbon email_verification_sent
 * @property string email_verification_hash
 */
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use Uuids;
    use Impersonate;

    const MAX_LOGIN_ATTEMPTS = 5;
    const LOGIN_BLOCKING = 60;

    /** @var bool $incrementing */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'login',
        'password',
        'my_id',
        'partner_id',
        'phone',
        'skype',
        'created_at',
        'blockio_wallet_btc',
        'blockio_wallet_ltc',
        'blockio_wallet_doge',
        'sex',
        'city',
        'country',
        'longitude',
        'latitude',
        'email_verified_at',
        'email_verification_sent',
        'email_verification_hash',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'tfa_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userTaskActions()
    {
        return $this->hasMany(UserTaskActions::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userTasks()
    {
        return $this->hasMany(UserTasks::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wallets()
    {
        return $this->hasMany(Wallet::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function telegramUser()
    {
        return $this->hasMany(TelegramUsers::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function taskPropositions()
    {
        return $this->hasMany(UserTaskPropositions::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function socialMeta()
    {
        return $this->hasMany(UsersSocialMeta::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function youtubeVideoWatches()
    {
        return $this->hasMany(YoutubeVideoWatch::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function deposits()
    {
        return $this->hasMany(Deposit::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user_ips()
    {
        return $this->hasMany(UserIp::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mailSents()
    {
        return $this->hasMany(MailSent::class, 'user_id');
    }

    /**
     * @param boolean $useSymbols
     * @param string $currencyId
     * @return array
     */
    public function getBalancesByCurrency($useSymbols = false, $currencyId = null): array
    {
        $wallets = $this->wallets()->with([
            'currency'
        ]);

        if (null !== $currencyId) {
            $wallets = $wallets->where('currency_id', $currencyId);
        }

        $wallets = $wallets->get();
        $balances = [];

        foreach ($wallets as $wallet) {
            $arrayKey = true === $useSymbols ? $wallet->currency->symbol : $wallet->currency->code;

            if (!isset($balances[$arrayKey])) {
                $balances[$arrayKey] = 0;
            }

            $balances[$arrayKey] += round($wallet->balance, $wallet->currency->precision);
        }

        return $balances;
    }

    /**
     * @param bool $useSymbols
     * @param string $operationType
     * @param int $approved
     * @return array
     * @throws \Exception
     */
    public function getTotalByTransactions($useSymbols = false, $operationType = null, $approved = 0): array
    {
        $total = [];
        $currencies = getCurrencies();

        foreach ($currencies as $currency) {
            $amount = Transaction::join('transaction_types', function ($join) {
                $join->on('transactions.type_id', '=', 'transaction_types.id');
            });

            if (null !== $operationType) {
                $amount = $amount->where('transaction_types.name', $operationType);
            }
            if (true === $approved) {
                $amount = $amount->where('transactions.approved', $approved);
            }
            $amount = $amount->where('transactions.currency_id', $currency['id'])
                ->where('user_id', getUserId())
                ->sum('amount');
            $arrayKey = true === $useSymbols ? $currency['symbol'] : $currency['code'];

            if (!isset($total[$arrayKey])) {
                $total[$arrayKey] = 0;
            }

            $total[$arrayKey] += round($amount, $currency['precision']);
        }

        return $total;
    }

    /**
     * @return bool
     */
    public function hasReferrals()
    {
        return self::where('partner_id', $this->my_id)->count() > 0;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function referrals()
    {
        return $this->hasMany(User::class, 'partner_id', 'my_id');
    }

    /**
     * @param int $level
     * @param bool $json
     * @return array
     */
    public function getReferralsOnLevel($level=1, bool $json = false)
    {
        $all = $this->getAllReferrals($json);

        return isset($all[$level])
            ? $all[$level]
            : null;
    }

    /**
     * @param int $level
     * @return array
     */
    public function getLevels($level=1)
    {
        $countReferrals = $this->referrals()->count();
        $levels         = [
            $level => $countReferrals
        ];

        if ($countReferrals > 0) {
            /** @var User $referral */
            foreach ($this->referrals()->get() as $referral) {
                foreach ($referral->getLevels($level+1) as $l => $v) {
                    if (isset($levels[$l])) {
                        $levels[$l] += $v;
                        continue;
                    }
                    if ($v > 0) {
                        $levels[$l] = $v;
                    }
                }
            }
        }

        return $levels;
    }

    /**
     * @param int $level
     * @return mixed
     * @throws \Exception
     */
    public function getLevels24h($level=1)
    {
        $countReferrals     = $this->referrals()
            ->count();
        $countReferrals24h  = $this->referrals()
            ->where('created_at', '>', now()->subDay()->toDateTimeString())
            ->count();
        $levels             = [
            $level => $countReferrals24h
        ];

        if ($countReferrals > 0) {
            /** @var User $referral */
            foreach ($this->referrals()->get() as $referral) {
                foreach ($referral->getLevels24h($level+1) as $l => $v) {
                    if (isset($levels[$l])) {
                        $levels[$l] += $v;
                        continue;
                    }
                    if ($v > 0) {
                        $levels[$l] = $v;
                    }
                }
            }
        }

        return $levels;
    }

    /**
     * @param bool $json
     * @param int $flag
     * @return array
     */
    public function getAllReferrals(bool $json = false, $flag=1)
    {
        /** @var User $referrals */
        $referrals  = $this->referrals()->get();
        $levels     = [];

        if (null !== $referrals) {
            $levels[$flag] = null;

            /** @var User $referral */
            foreach ($referrals as $referral) {
                $levels[$flag][] = true === $json
                    ? $referral->toJson()
                    : $referral->toArray();

                if ($referral->hasReferrals()) {
                    foreach ($referral->getAllReferrals($json, $flag+1) as $l => $list) {
                        foreach ($list as $v) {
                            $levels[$l][] = $v;
                        }
                    }
                }
            }
        }

        return $levels;
    }

    /**
     * @param $level
     * @return int
     */
    public function getReferralOnLoadPercent($level)
    {
        return Referral::getOnLoad($level);
    }

    /**
     * @param $level
     * @return int
     */
    public function getReferralOnProfitPercent($level)
    {
        return Referral::getOnProfit($level);
    }

    /**
     * @param $level
     * @return int
     */
    public function getReferralOnTaskPercent($level)
    {
        return Referral::getOnTask($level);
    }

    /**
     * @param User $user |null
     * @param bool $json
     * @return array|string
     */
    public static function getReferralsTree(User $user = null, $json = false)
    {
        $user['referrals'] = [];

        if ($user->hasReferrals()) {
            foreach ($user->referrals()->get() as $referral) {
                $referral['deposits'] = $referral->deposits()
                    ->with('transactions')
                    ->get()
                    ->toArray();
                $referral['referrals'] = self::getReferralsTree($referral);

                if (false === $json) {
                    return $referral->toArray();
                }
                return $referral->toJson();
            }

            if (false === $json) {
                return $user->toArray();
            }
            return $user->toJson();
        }

        return null;
    }

    /**
     * @param User|null $user
     * @return array|Repository
     * @throws
     */
    public static function getD3V3ReferralsTree(User $user = null): array
    {
        if (empty($user)) {
            return [];
        }

        $referrals = [];
        $referrals['name'] = $user->email;

        if (!$user->hasReferrals()) {
            return $referrals;
        }

        foreach ($user->referrals()->get() as $r) {
            $referral = self::getD3V3ReferralsTree($r);
            $referrals['children'][] = $referral;
        }

        return $referrals;
    }

    /**
     * @return array
     */
    public function getPartnerLevels()
    {
        static $partnerLevel = 0;
        static $partnerLevels;

        if ($user = User::where('my_id', $this->partner_id)->first()) {
            $partnerLevels[] = ++$partnerLevel;
            $user->getPartnerLevels();
        }
        return !empty($partnerLevels) ? $partnerLevels : [];
    }

    /**
     * @param $plevel
     * @param bool $json
     * @return mixed
     */
    public function getPartnerOnLevel($plevel, bool $json = false)
    {
        if ($user = User::where('my_id', $this->partner_id)->first()) {
            if ($plevel == 1) {
                if (true === $json) {
                    return $user->toArray();
                }
                return $user;
            }
            $plevel = $plevel - 1;

            return $user->getPartnerOnLevel($plevel, $json);
        }
        return null;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public static function accruedBalances(): array
    {
        $bonusBalances      = Transaction::transactionBalances('bonus');
        $depositsBalances   = Deposit::closedBalances();
        $referralRecharge   = Transaction::transactionBalances('partner');
        $referralDeposit    = Transaction::transactionBalances('dividend');

        foreach (Currency::all() as $currency) {
            $balances[$currency->code] = $depositsBalances[$currency->code] + $bonusBalances[$currency->code] + $referralDeposit[$currency->code] + $referralRecharge[$currency->code];
        }
        return isset($balances) ? $balances : [];
    }

    /**
     * @param string $code
     * @param array $data
     * @param int $delay
     * @throws \Throwable
     */
    public function sendNotification(string $code, array $data, int $delay=0)
    {
        $this->sendEmailNotification($code, $data);
        $this->sendTelegramNotification($code, $data, null, $delay);
    }

    /**
     * @param string $code
     * @param array $data
     * @param bool $skipVerified
     * @param int $delay
     * @return bool
     * @throws \Throwable
     */
    public function sendEmailNotification(string $code, array $data, bool $skipVerified=false, int $delay=0)
    {
//        if (false === $skipVerified
//            && config('mail.usersShouldVerifyEmail') == true
//            && false === $this->isVerifiedEmail()) {
//            \Log::info('User email is not verified for accepting mails.');
//            return false;
//        }

        $subjectView    = 'mail.subject.'.$code;
        $bodyView       = 'mail.body.'.$code;

        if (!view()->exists($subjectView) || !view()->exists($bodyView)) {
            return false;
        }

        $html = view('mail.body.'.$code, array_merge([
            'user'      => $this,
        ], $data))->render();

        if (empty($html)) {
            return false;
        }

        $notificationMail = (new NotificationMail($this, $code, $data))
            ->onQueue(getSupervisorName().'-emails')
            ->delay(now()->addSeconds($delay));
        \Mail::to($this)->queue($notificationMail);
    }

    /**
     * @param string $code
     * @param array $data
     * @param null $bot
     * @param int $delay
     */
    public function sendTelegramNotification(string $code, array $data, $bot=null, int $delay=0)
    {
        TelegramNotificationJob::dispatch($this, $code, $data, $bot)->onQueue(getSupervisorName().'-default')->delay(now()->addSeconds($delay));
    }

    /**
     * @param string $code
     * @param array $data
     * @throws \Throwable
     */
    public static function notifyAdmins(string $code, array $data) {
        self::notifyAdminsViaNotificationBot($code, $data);
        self::notifyAdminsViaEmail($code, $data);
    }

    /**
     * @param string $code
     * @param array $data
     * @throws \Throwable
     */
    public static function notifyAdminsViaEmail(string $code, array $data)
    {
        /*
         * Search admins
         */
        $adminRoles     = \DB::table('roles')
            ->whereIn('name', ['root', 'admin'])
            ->get();
        $adminRolesIds  = [];

        foreach ($adminRoles as $adminRole) {
            $adminRolesIds[] = $adminRole->id;
        }

        if (count($adminRolesIds) == 0) {
            return;
        }

        $roles = \DB::table('model_has_roles')
            ->whereIn('role_id', $adminRolesIds)
            ->where('model_type', 'App\Models\User')
            ->get();

        foreach ($roles as $role) {
            /** @var User $admin */
            $admin = User::find($role->model_id);
            \Log::info('Found admin for support email: '.$admin->email);
            $admin->sendEmailNotification($code, $data, true);
        }
    }

    /**
     * @param string $code
     * @param array $data
     * @throws \Throwable
     */
    public static function notifyAdminsViaNotificationBot(string $code, array $data)
    {
        /*
         * Search admins
         */
        $adminRole = \DB::table('roles')
            ->where('name', 'root')
            ->first();

        if (null == $adminRole) {
            return;
        }

        $roles              = \DB::table('model_has_roles')
            ->where('role_id', $adminRole->id)
            ->where('model_type', 'App\Models\User')
            ->get();
        /** @var TelegramBots $notificationBot */
        $notificationBot    = TelegramBots::where('keyword', 'notification_bot')->first();

        foreach ($roles as $role) {
            /** @var User $admin */
            $admin = User::find($role->model_id);
            $admin->sendTelegramNotification($code, $data, $notificationBot);
        }
    }

    /**
     * @return void
     */
    public function addIp()
    {
        UserIp::addIp($this->id);
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = Hash::make($password);
        $this->save();
        return $this;
    }

    /**
     * @return string
     */
    public function generateTfaToken(): string
    {
        $this->tfa_token = str_random(6);
        $this->save();
        return $this->tfa_token;
    }

    /**
     * @return bool
     */
    public function unsetTfaToken()
    {
        if ($this->tfa_token === Session::get('tfa_token')) {
            $this->tfa_token = null;
            Session::forget('tfa_token');
            Session::forget('sended');
            return $this->save();
        }

        return false;
    }

    /**
     * @return User|null
     */
    public static function topPartner()
    {
        $users = self::whereNotNull('partner_id')
            ->select(DB::raw('partner_id, count(1) as r_count'))
            ->groupBy('partner_id')
            ->get();

        if ($users->count() == 0) {
            return null;
        }

        $partner = $users->firstWhere('r_count', $users->max('r_count'));

        if (empty($partner)) {
            return null;
        }

        $user = self::where('my_id', $partner->partner_id)->first();

        if (empty($user)) {
            return null;
        }

        $user->referrals_amount = $partner->r_count;

        return $user;
    }

    /**
     * @return bool
     */
    public function isMan()
    {
        return $this->sex == 'man';
    }

    /**
     * @return bool
     */
    public function isWoman()
    {
        return $this->sex == 'woman';
    }

    /**
     * @param string $coordinates
     * @return bool
     */
    public function setCoordinatesLonLat(string $coordinates='')
    {
        $coordinates = preg_replace('/ /', '', $coordinates);

        if (!preg_match('/\,/', $coordinates)) {
            return false;
        }

        $arrayCoordinates = explode(',', $coordinates); // longitude,latitude

        $this->longitude = $arrayCoordinates[0];
        $this->latitude  = $arrayCoordinates[1];
        return $this->save();
    }

    /**
     * @param string $coordinates
     * @return bool
     */
    public function setCoordinatesLatLong(string $coordinates='')
    {
        $coordinates = preg_replace('/ /', '', $coordinates);

        if (!preg_match('/\,/', $coordinates)) {
            return false;
        }

        $arrayCoordinates = explode(',', $coordinates); // latitude,longitude

        $this->latitude = $arrayCoordinates[0];
        $this->longitude  = $arrayCoordinates[1];
        return $this->save();
    }

    /**
     * @return bool
     */
    public function isVerifiedEmail()
    {
        return $this->email_verified_at !== null;
    }

    /**
     * @return bool
     */
    public function canSendVerificationEmail()
    {
        if ($this->email_verification_sent == null) {
            return true;
        }

        return abs(Carbon::parse($this->email_verification_sent)->diffInMinutes(now())) > 1;
    }

    /**
     * @return bool
     * @throws \Throwable
     */
    public function sendVerificationEmail()
    {
        if (config('mail.usersShouldVerifyEmail') != true) {
            return false;
        }

        if (false === $this->canSendVerificationEmail()) {
            return false;
        }

        if (empty($this->email)) {
            return false;
        }

        $this->email_verification_sent = now();
        $this->email_verification_hash = md5($this->email.config('app.name'));
        $this->save();

        $this->sendEmailNotification('email_verification', [
            'email_verification_hash' => $this->email_verification_hash,
        ], true);

        return true;
    }

    /**
     * @param string|null $email
     * @return string
     */
    private function getEmailVerificationHash(string $email=null)
    {
        if (null === $email) {
            return null;
        }

        return md5($email.config('app.name'));
    }

    /**
     * @return bool
     * @throws \Throwable
     */
    public function refreshEmailVerificationAndSendNew()
    {
        if ($this->email_verification_hash != $this->getEmailVerificationHash($this->email)) {
            return $this->sendVerificationEmail();
        }
    }
}
