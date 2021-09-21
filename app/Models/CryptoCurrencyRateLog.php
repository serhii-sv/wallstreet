<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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
    public $keyType = 'string';

    /**
     * @var string[]
     */
    protected $fillable = [
        'currency_id',
        'rate',
        'date',
        'time'
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
     * @param null $time
     */
    public static function setRateLog($rate, $date = null, $time = null)
    {
        list($currency) = explode('_to_', $rate->s_key);
        $currency = Currency::where('code', $currency)->first();

        $date = !is_null($date) ? date('Y-m-d', strtotime($date)) : date('Y-m-d');
        $time = !is_null($time) ? date('H:i:s', strtotime($time)) : date('H:i:s');

        $currency->rateLog()->updateOrCreate(
            [
                'date' => $date,
                'time' => $time
            ],
            [
                'rate' => $rate->s_value,
                'date' => $date,
                'time' => $time
            ]
        );
    }

    /**
     * @param $wallet
     * @return array
     */
    public static function getChartData($wallet)
    {
        $rateLog = $wallet->currency
            ->rateLog()
            ->where('date', '>=', Carbon::now()->subDays(7))
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();

        $data = [];
        $chartData = [];

        foreach ($rateLog as $item) {
            $data[$item->date][] = $item;
        }

       foreach ($data as $date => $items) {
           $chartData[] = [
               'key' => Carbon::parse($date)->format('D'),
               'value' => collect($items)->last()->rate
           ];
       }

       return $chartData;
    }
}
