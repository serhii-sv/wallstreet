<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryLog extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'salary_log';

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'stat_left',
        'stat_salary',
        'stat_different',
        'stat_withdraws',
        'stat_deposits',
        'stat_salary_percent',
        'stat_worker_withdraw'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
