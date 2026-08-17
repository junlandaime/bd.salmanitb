<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role'               => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission'         => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,

            // Taaruf Feature
            'taaruf.eligible'        => \App\Http\Middleware\EnsureTaarufEligible::class,
            'taaruf.profile.exists'  => \App\Http\Middleware\EnsureTaarufProfileExists::class,
            'taaruf.profile.active'  => \App\Http\Middleware\EnsureTaarufProfileActive::class,
            'spn.step'               => \App\Http\Middleware\SpnRegistrationGuard::class,
        ]);
    })
    ->withSchedule(function (Schedule $schedule) {
        // Auto-promote verified SPN registrants to alumni after batch ends
        $schedule->command('spn:promote-alumni')->daily()->at('01:00');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
