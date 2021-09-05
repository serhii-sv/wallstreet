<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyExchange extends Model
{
    use HasFactory;
    use Uuids;
    protected $guarded = ['_token'];
    protected $table = 'currency_exchange';
    
    public function user() {
        return $this->belongsTo(User::class, 'user_id','id');
    }
    public function currency_in() {
        return $this->belongsTo(Currency::class, 'currency_in','id');
    }
    public function currency_out() {
        return $this->belongsTo(Currency::class, 'currency_out','id');
    }
}
