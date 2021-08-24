<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use Uuids;

    public $keyType      = 'string';

    /** @var bool $incrementing */
    public $incrementing = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        'slug',
        'title',
        'short_description',
        'description',
        'in_stock',
        'price',
        'active',
        'image'
    ];
}
