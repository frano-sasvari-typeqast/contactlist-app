<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;

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
        'password_old',
        'password_old_confirmation',
        'password_new',
        'password_new_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }

    /**
     * Render the given HttpException.
     *
     * @param  \Symfony\Component\HttpKernel\Exception\HttpException  $e
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function renderHttpException(HttpException $e)
    {
        $status = $e->getStatusCode();

        $paths = collect(config('view.paths'));

        view()->replaceNamespace('errors', $paths->map(function ($path) {
            return "{$path}/errors";
        })->push(__DIR__.'/views')->all());

        $config = $this->container->get('config');

        if ($config->get('app.url') == $config->get('app.url_cdn') && view()->exists($view = "cdn.errors.{$status}")) {
            return response()->view($view, ['exception' => $e], $status, $e->getHeaders());
        } elseif (view()->exists($view = "web.errors.{$status}")) {
            return response()->view($view, ['exception' => $e], $status, $e->getHeaders());
        }

        return $this->convertExceptionToResponse($e);
    }

    /**
     * Get the default context variables for logging.
     *
     * @return array
     */
    protected function context()
    {
        try {
            return array_filter([
                'method' => Request::method(),
                'url' => Request::fullUrl(),
                'url_previous' => URL::previous(),
                'input' => Request::except($this->dontFlash),
            ]);
        } catch (Throwable $e) {
            return [];
        }
    }
}
