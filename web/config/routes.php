<?php

use Slim\App;
use App\Controllers\PostController;

return function (App $app) {
    $app->get('/', function () {
        echo 'Route is working!';die;
    });

    $app->get('/post', [PostController::class, 'index']);
    $app->post('/post', [PostController::class, 'create']);
    $app->patch('/post/{id}/edit', [PostController::class, 'edit']);
    $app->delete('/post/{id}', [PostController::class, 'destroy']);
    $app->get('/post/{id}', [PostController::class, 'show']);
};