<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use Uuids;

    /**
     * @var string
     */
    public $keyType = 'string';

    /**
     * @var bool
     */
    public $incrementing = false;

    /** @var string $table */
    protected $table = 'news';

    /** @var array $fillable */
    protected $fillable = [
        'content',
        'title',
        'short_content',
        'image'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'content' => 'array',
        'title' => 'array',
        'short_content' => 'array',
    ];
}
