<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Models;

use App\Traits\Uuids;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Rate
 * @package App\Models
 *
 * @property string id
 * @property string currency_id
 * @property string name - название тарифного плана.
 * @property float min - минимальная сумма инвестиций.
 * @property float max - максимальная сумма инвестиций.
 * @property float daily - процент ежедневных начислений, может не задаваться.
 * @property integer duration - продолжительность действия депозита (в днях) равно кол-ву ежедневных начислений.
 * @property integer reinvest - активна ли возможность реинвестировоать в депозит.
 * @property integer autoclose - автозакрытие депозитов по этому плану.
 * @property integer active - активен ли тарифный план.
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Rate extends Model
{
    use Uuids;
    public $keyType      = 'string';
    /** @var bool $incrementing */
    public $incrementing = false;

    /** @var array $fillable */
    protected $fillable = [
        'name',
        'min',
        'max',
        'daily',
        'duration',
        'reinvest',
        'autoclose',
        'active',
        'upgradable',
        'refund_deposit'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function deposits()
    {
        return $this->hasMany(Deposit::class,'rate_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class,'rate_id');
    }
}
