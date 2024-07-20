<?php

use App\Http\Middleware\JwtMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function (){
            Route::middleware('web')->group(base_path('routes/api.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'JWTAuth' => Tymon\JWTAuth\Facades\JWTAuth::class,
            'JWTFactory' => Tymon\JWTAuth\Facades\JWTFactory::class,
            'jwt.verify' => \App\Http\Middleware\JwtMiddleware::class,
        ]);

        // $middleware->append(JwtMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {

    })->create();
