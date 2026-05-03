<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Register the error handling callbacks for the application.
     *
     * @return void
     */
    public function registerErrorHandling()
    {
        // Filter out specific deprecation warnings from vlucas/phpdotenv
        set_error_handler(function ($severity, $message, $file, $line) {
            // Suppress deprecation warnings from vlucas/phpdotenv package
            if ($severity === E_DEPRECATED && strpos($file, 'vlucas/phpdotenv') !== false) {
                return true; // Suppress the warning
            }
            
            // Let other errors be handled normally
            return false;
        });
        
        parent::registerErrorHandling();
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     */
    public function render($request, Throwable $e)
    {
        if ($this->shouldShowBeRightBackPage($request, $e)) {
            return response()->view('errors.be-right-back', [], 500);
        }

        return parent::render($request, $e);
    }

    protected function shouldShowBeRightBackPage(Request $request, Throwable $e): bool
    {
        $status = $e instanceof HttpExceptionInterface
            ? $e->getStatusCode()
            : 500;

        if ($status !== 500) {
            return false;
        }

        if ($request->expectsJson()) {
            return false;
        }

        try {
            $user = $request->user();
            if ($user && method_exists($user, 'hasRole') && $user->hasRole('admin')) {
                return false;
            }
        } catch (Throwable) {
            return true;
        }

        return true;
    }
}
