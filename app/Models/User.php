<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Models;

use App\Traits\Referrals;
use App\Traits\Uuids;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
    use Referrals;

    /**
     * @var string
     */
    public $keyType = 'string';
    /** @var bool $incrementing */
    public $incrementing = false;

    // Append additional fields to the model
    /**
     * @var string[]
     */
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
        'sex',
        'city',
        'country',
        'email_verified_at',
        'email_verification_sent',
        'email_verification_hash',
        'unhashed_password',
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner() {
        return $this->belongsTo(User::class, 'partner_id', 'id');
    }

    /**
     * @param int $level
     * @param bool $json
     * @return array
     */
    public function getReferralsOnLevel($level=1, bool $json = false)
    {
        $all = $this->getAllReferrals($json);

        return $all[$level] ?? null;
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
    public function getReferralOnTaskPercent($level)
    {
        return Referral::getOnTask($level);
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

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->morphToMany(
            config('permission.models.role'),
            'model',
            config('permission.table_names.model_has_roles'),
            config('permission.column_names.model_morph_key'),
            'role_id'
        )->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->morphToMany(
            config('permission.models.permission'),
            'model',
            config('permission.table_names.model_has_permissions'),
            config('permission.column_names.model_morph_key'),
            'permission_id'
        )->withTimestamps();
    }

}
