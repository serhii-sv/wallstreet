<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Faq
 * @package App\Models
 *
 * @property string lang_id
 * @property string title
 * @property string text
 * @property Carbon created_at
 */
class Faq extends Model
{
    /** @var array $fillable */
    protected $fillable = [
        'lang_id',
        'title',
        'text',
        'created_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lang()
    {
        return $this->belongsTo(Language::class, 'lang_id');
    }

}
