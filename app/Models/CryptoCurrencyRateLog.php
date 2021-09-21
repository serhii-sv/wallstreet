<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoCurrencyRateLog extends Model
{
    use HasFactory;
    use Uuids;

    /**
     * @var string
     */
    protected $table = 'crypto_currency_rates_log';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    public $keyType      = 'string';

    /**
     * @var string[]
     */
    protected $fillable = [
        'currency_id',
        'rate',
        'date'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * @param $rate
     * @param null $date
     */
    public static function setRateLog($rate, $date = null)
    {
        list($currency) = explode('_to_', $rate->s_key);
        $currency = Currency::where('code', $currency)->first();

        $date = !is_null($date) ? date('Y-m-d', strtotime($date)) : date('Y-m-d');

        $currency->rateLog()->updateOrCreate(
            [
                'date' => $date
            ],
            [
                'rate' => $rate->s_value,
                'date' => $date
            ]
        );
    }
}
