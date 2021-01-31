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

    $authMiddleware($app->group('', function ($app) {
        $app->post('/post', [PostController::class, 'create']);
        $app->patch('/post/{id}/edit', [PostController::class, 'edit']);
        $app->delete('/post/{id}', [PostController::class, 'destroy']);
        $app->get('/post/{id}', [PostController::class, 'show']);
    }));

    $app->group('/auth', function ($app) {
        $app->post('/register', [RegisterController::class, 'register']);
        $app->post('/login', [LoginController::class, 'login']);
    });
};