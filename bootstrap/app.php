<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Đăng ký middleware toàn cục
        // $middleware->append(\App\Http\Middleware\YourGlobalMiddleware::class);

        // Đăng ký middleware alias (tương tự $routeMiddleware trong Kernel.php)
        $middleware->alias([
            'admin' => \App\Http\Middleware\Admin::class,
        ]);

        // Nếu cần thêm middleware vào nhóm web hoặc api
        $middleware->web(append: [
            // Ví dụ: thêm middleware tùy chỉnh vào nhóm web
        ]);

        $middleware->api(append: [
            // Ví dụ: thêm middleware vào nhóm api
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
