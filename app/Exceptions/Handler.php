<?php

namespace App\Exceptions;

use Error;
use Throwable;
use ErrorException;
use BadMethodCallException;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Database\QueryException;
use Symfony\Component\ErrorHandler\Error\FatalError;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{

    use ApiResponseTrait;

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

        // $this->renderable(function (NotFoundHttpException $e, $request) {
        //     return  $this->apiResponse(404, "Not Found", "Object Not Found");
        // });

        // $this->renderable(function (MethodNotAllowedHttpException $e) {
        //     return  $this->apiResponse(405, "Method Not Allowed", $_SERVER['REQUEST_METHOD'] . " Method Is Not Allowed For This Route");
        // });

        // $this->renderable(function (AccessDeniedHttpException $e) {
        //     return  $this->apiResponse(403, "Unauthorized Action", $e->getMessage());
        // });

        // $this->renderable(function (QueryException $e) {
        //     return  $this->apiResponse(500, "DataBase Error", $e->getMessage());
        // });

        // $this->renderable(function (BadMethodCallException $e) {
        //     return  $this->apiResponse(500, "Method Deos Not Exist", $e->getMessage());
        // });

        // $this->renderable(function (Error $e) {
        //     return  $this->apiResponse(500, "Error", $e->getMessage());
        // });

        // $this->renderable(function (ErrorException $e) {
        //     return  $this->apiResponse(500, "Error", $e->getMessage());
        // });

        // $this->renderable(function (FatalError $e) {
        //     return  $this->apiResponse(500, "Fetal Error ", $e->getMessage());
        // });

        // $this->renderable(function (BindingResolutionException $e) {
        //     return  $this->apiResponse(500, "Bind Error ", $e->getMessage());
        // });
    }
}