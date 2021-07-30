<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Observers;

use App\Models\NewsLang;

/**
 * Class NewsLangObserver
 * @package App\Observers
 */
class NewsLangObserver
{
    /**
     * Listen to the NewsLang created event.
     *
     * @param NewsLang $newsLang
     * @return void
     * @throws
     */
    public function created(NewsLang $newsLang)
    {
    
    }
    
    /**
     * Listen to the NewsLang deleting event.
     *
     * @param NewsLang $newsLang
     * @return void
     * @throws
     */
    public function deleted(NewsLang $newsLang)
    {
    
    }

    /**
     * Listen to the NewsLang updating event.
     *
     * @param NewsLang $newsLang
     * @return void
     * @throws
     */
    public function updated(NewsLang $newsLang)
    {
    
    }
}