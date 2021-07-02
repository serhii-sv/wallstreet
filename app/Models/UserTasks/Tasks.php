<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Models\UserTasks;

use App\Models\Currency;
use App\Models\PaymentSystem;
use App\Traits\Uuids;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tasks
 * @package App\Models\UserTasks
 *
 * @property string id
 * @property string title
 * @property string description
 * @property float reward_amount
 * @property PaymentSystem reward_payment_system_id
 * @property Currency reward_currency_id
 * @property Carbon deadline
 * @property string category
 * @property string social_category
 *
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Tasks extends Model
{
    use Uuids;

    /** @var bool $incrementing */
    public $incrementing = false;

    /** @var array $timestamps */
    public $timestamps = ['created_at', 'updated_at'];

    /** @var array $fillable */
    protected $fillable = [
        'title',
        'description',
        'reward_amount',
        'reward_payment_system_id',
        'reward_currency_id',
        'deadline',
        'category',
        'social_category',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentSystem()
    {
        return $this->belongsTo(PaymentSystem::class, 'reward_payment_system_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'reward_currency_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function actions()
    {
        return $this->hasMany(TaskActions::class, 'task_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userTasks()
    {
        return $this->hasMany(UserTasks::class, 'task_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userTaskPropositions()
    {
        return $this->hasMany(UserTaskPropositions::class, 'task_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function coefficients()
    {
        return $this->hasMany(TaskCoefficients::class, 'task_id');
    }
}
