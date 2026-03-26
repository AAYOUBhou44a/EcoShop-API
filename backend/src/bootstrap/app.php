<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
<<<<<<< HEAD
<<<<<<< HEAD
        api: __DIR__.'/../routes/api.php',
=======
>>>>>>> dev
=======
>>>>>>> dev
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
<<<<<<< HEAD
<<<<<<< HEAD
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
=======
=======
>>>>>>> dev
        // C'est ICI que tu désactives le CSRF globalement
        $middleware->validateCsrfTokens(except: [
            '*', 
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
<<<<<<< HEAD
    })->create();
z
    })->create();

