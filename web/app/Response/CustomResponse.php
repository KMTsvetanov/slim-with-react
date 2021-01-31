<?php

namespace App\Response;

use \Psr\Http\Message\ResponseInterface;

class CustomResponse
{
    public function jsonResponse(ResponseInterface $response, $status = 200, $success = true, $data = [], $message = '')
    {
        $response->getBody()->write(json_encode([
            'success' => $success,
            'data' => $data,
            'message' => $message,
        ]));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($status);
    }
}