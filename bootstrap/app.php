<?php

use App\Http\Middleware\AdminAuthMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->alias([
            'auth.admin' => AdminAuthMiddleware::class,
        ]);

        // Configure CORS
        $middleware->validateCsrfTokens(except: [
            'sanctum/csrf-cookie',
            'api/*',
        ]);

        $middleware->trustProxies(at: [
            '*',
        ]);

        // CORS configuration
        $middleware->api(append: [
            \Illuminate\Http\Middleware\HandleCors::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {

        $exceptions->renderable(function (ValidationException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation failed.',
                    'errors' => $e->errors(),
                    'code' => Response::HTTP_UNPROCESSABLE_ENTITY
                ]);
            }
        });
    })->create();
