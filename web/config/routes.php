<?php

use Slim\App;
use App\Controllers\PostController;
use App\Controllers\Auth\RegisterController;
use App\Controllers\Auth\LoginController;

return function (App $app, $authMiddleware) {
    $app->get('/', function () {
        echo 'Route is working!';die;
    });

    $app->get('/post', [PostController::class, 'index']);

    $app->post('/post', [PostController::class, 'create']);
    // TODO Push Back in
    $app->get('/post/{id}', [PostController::class, 'show']);
    $app->post('/post/{id}/edit', [PostController::class, 'edit']);
    $app->delete('/post/{id}', [PostController::class, 'destroy']);
    $authMiddleware($app->group('', function ($app) {
    }));

    $app->group('/auth', function ($app) {
        $app->post('/register', [RegisterController::class, 'register']);
        $app->post('/login', [LoginController::class, 'login']);
    });
};