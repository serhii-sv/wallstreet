<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Middleware;

use Closure;
use App;

/**
 * Class SetLang
 * @package App\Http\Middleware
 */
class SetLastActivity
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->check()) {
            auth()->user()->setLastActivity();
        }

        return $next($request);
    }
}
