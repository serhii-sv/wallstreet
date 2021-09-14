<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateGroup extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
        'reinvest',
        'refund_deposit',
    ];
    protected $guarded = ['_token'];
}
