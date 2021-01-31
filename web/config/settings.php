<?php

use Psr\Container\ContainerInterface;

return function (ContainerInterface $container) {
    $container->set('settings', function () {
        $db = require_once __DIR__ . '/database.php';

        return compact('db');
    });

    $container->set('imagesDir', function () {
        return __DIR__ . '/../public/images';
    });
};