<?php
/**
 * Copyright. "Hyipium" engine. All rights reserved.
 * Any questions? Please, visit https://hyipium.com
 */

namespace App\Exceptions;

use App\Jobs\SendLogsJob;
use App\Models\Telegram\TelegramBots;
use App\Models\User;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * @param Exception $exception
     * @return mixed|void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param Exception $exception
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Throwable
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
            return redirect()->route('customer.main')->with('errors', __('Unauthorized access'));
        }

        $message = $exception->getMessage();

        $stopWords = [
            'Unauthenticated',
            'invalid_grant',
        ];

        foreach ($stopWords as $stopWord) {
            if (preg_match('/'.$stopWord.'/', $message)) {
                return parent::render($request, $exception);
            }
        }

        if (!empty($exception->getMessage())) {
            SendLogsJob::dispatch($message)->onQueue(getSupervisorName().'-low')->delay(0);
        }
        return parent::render($request, $exception);
    }
}
