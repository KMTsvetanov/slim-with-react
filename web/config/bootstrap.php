<?php

use DI\Container;
use DI\Bridge\Slim\Bridge as SlimAppFactory;

require_once __DIR__ . '/../vendor/autoload.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH');

$container = new Container();

$app = SlimAppFactory::create($container);

$settings = require_once __DIR__ . '/settings.php';
$settings($container);

$app->addBodyParsingMiddleware();

$middleware = require_once __DIR__ . '/middleware.php';
$middleware($app);

$authMiddleware = require_once __DIR__ . '/authMiddleware.php';
$routes = require_once __DIR__ . '/routes.php';
$routes($app, $authMiddleware);

$app->run();