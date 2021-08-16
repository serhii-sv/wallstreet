<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserThemeSetting extends Model
{
    use HasFactory;
    use Uuids;

    /**
     * @var string
     */
    public $keyType = 'string';
    /** @var bool $incrementing */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $table = 'user_theme_settings';

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'theme_settings'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'theme_settings' => 'array'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return array
     */
    public static function getThemeSettings()
    {
        return auth()->user()->themeSettings->theme_settings ?? [];
    }
}
