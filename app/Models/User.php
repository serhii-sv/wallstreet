<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Models;

use App\Traits\Uuids;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use HasPermissions;
    use Uuids;
    use Impersonate;
    public $keyType = 'string';
    /** @var bool $incrementing */
    public $incrementing = false;

    // Append additional fields to the model
    protected $appends = [
        'short_name',
        'last_activity'
    ];

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
        'unhashed_password',
        'stat_deposits',
        'stat_withdraws',
        'stat_different',
        'stat_salary',
        'stat_accepted',
        'stat_left',
        'stat_additional',
        'stat_salary_percent',
        'stat_worker_withdraw',
        'ip',
        'is_locked',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
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
    public function wallets()
    {
        return $this->hasMany(Wallet::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function deposits()
    {
        return $this->hasMany(Deposit::class, 'user_id');
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
     * Accessor for short name
     * On the right sidebar menu with all users sometimes names are too long
     * @return false|mixed|string
     */
    public function getShortNameAttribute(){
        if(strlen($this->name) <= 18)
            return $this->name;

        if(explode(' ', $this->name)[0] <= 15)
            return explode(' ', $this->name)[0] . " " . substr(explode(' ', $this->name)[1], 0, 1) . ".";

        if(explode(' ', $this->name)[0] <= 18)
            return explode(' ', $this->name)[0];

        return substr($this->name, 0, 15) . "...";
    }

    /**
     * Accessor for last activity field
     * Used at the moment for indicate if user is online for at least 2 minutes ago
     * @return array
     */
    public function getLastActivityAttribute(){
        if($this->last_activity_at === null)
            return [
                'is_online' => false,
                'last_seen' => 'Wait auth'
            ];

        $currentDate = Carbon::make($this->last_activity_at);

        if($currentDate->greaterThanOrEqualTo(Carbon::now()->startOfDay()))
            return [
                'is_online' => Carbon::now()->subSeconds(config('chats.max_idle_sec_to_be_online'))->lessThan($currentDate),
                'last_seen' => $currentDate->format("g.i A")
            ];

        return [
            'is_online' => false,
            'last_seen' => $currentDate->format("j \of M")
        ];
    }

    /**
     * Mutator for last activity field
     * @param \DateTime|null $time
     * @return User
     */
    public function setLastActivity(\DateTime $time = null){
        $this->last_activity_at = $time;

        if($time === null)
            $this->last_activity_at = new \DateTime();

        $this->save();

        return $this;
    }
}
