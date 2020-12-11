<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {

        $debug = config('app.debug'); 
        $message = '';
        $statusCode = 500;

        if($debug) {

            return parent::render($request, $exception);

        }

        if($exception instanceof NotFoundHttpException) {

            $message = "end point yang tujuan kamu tidak tersedia";
            $statusCode = 404;

        }else if($exception instanceof MethodNotAllowedException) {

            $message = "Aksi ini tidak di izinkan";
            $statusCode = 405;

        }else if($exception instanceof ModelNotFoundException){
            $message = "Data yang kamu cari tidak ketemu";
            $statusCode = 404;
        }else if($exception instanceof ValidationException) {

            $errors = $exception->validator()->errors()->getMessage();
            $message = array_map(function($error){
                return array_map(function($message) {
                    return $message;
                }, $error); 
            }, $errors);
            $statusCode = 405;
        }else{
            $message = "Terjadi Kesalahan pada sistem kami, silah coba lagi nanti";
            $statusCode = 500;
        }

        return response()
            ->json([
                'status' => 'error',
                'message' => $message,
            ], $statusCode);

    }
}
