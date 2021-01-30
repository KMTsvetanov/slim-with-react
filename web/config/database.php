<?php

use Illuminate\Database\Capsule\Manager;

$databaseConfig = [
    'driver' => 'mysql',
    'host' => 'host.docker.internal',
    'database' => 'DBname',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',
    'port' => '4306',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
];

$capsule = new Manager();
$capsule->addConnection($databaseConfig);
$capsule->setAsGlobal();
$capsule->bootEloquent();

return $capsule;