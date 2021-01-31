<?php

use Tuupola\Middleware\JwtAuthentication;
use App\Interfaces\SecretKeyInterface;

return function ($group) {
    $group->add(
        new JwtAuthentication([
            'ignore' => [
                '/auth/login',
                '/auth/register',
            ],
            'secret' => SecretKeyInterface::JWT_SECRET_KEY,
            'error' => function ($response, $arguments) {
                $data['success'] = false;
                $data['response'] = $arguments['message'];
                $data['status_code'] = '401';

                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->getBody()->write(json_encode($data));
            }
        ])
    );
};