<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/perfectmoney/status',
        '/advcash/status',
        '/payeer/status',
        '/blockio/status',
        '/coinpayments/status',
        '/enpay/status',
        '/nixmoney/status',
        '/topup/payment_message',

        '/telegram_webhook/*',
        '/youtube/watch/save/*/*',
    ];
}
