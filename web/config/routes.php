<?php

use Slim\App;

return function (App $app) {
    $app->get('/', function () {
        echo 'Route is working!';die;
    });
};