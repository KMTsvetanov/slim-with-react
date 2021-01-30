<?php

use Slim\App;
use App\Controllers\GuestEntryController;

return function (App $app) {
    $app->get('/', function () {
        echo 'Routing works!';die;
    });
};