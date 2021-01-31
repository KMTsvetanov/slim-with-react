<?php

namespace App\Controllers\Auth;

use App\Requests\CustomRequestHandler;
use App\Response\CustomResponse;
use App\Validation\AuthValidation;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\Controllers\GenerateTokenController;

/**
 * Class LoginController
 * @package App\Controllers\Auth
 */
class LoginController
{
    /**
     * @var CustomResponse
     */
    private $customResponse;
    /**
     * @var AuthValidation
     */
    private $authValidation;

    /**
     * RegisterController constructor.
     * @param CustomResponse $customResponse
     * @param AuthValidation $authValidation
     */
    public function __construct(CustomResponse $customResponse, AuthValidation $authValidation)
    {
        $this->customResponse = $customResponse;
        $this->authValidation = $authValidation;
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param CustomRequestHandler $customRequestHandler
     * @return ResponseInterface
     */
    public function login(RequestInterface $request, ResponseInterface $response, CustomRequestHandler $customRequestHandler): ResponseInterface
    {
        if (!$this->authValidation->login($request)) {
            return $this->customResponse->jsonResponse($response, 400, false, [], $this->authValidation->getErrors());
        }

        $generateToken = GenerateTokenController::generateToken($customRequestHandler::getParam($request, 'email'));

        return $this->customResponse->jsonResponse($response, 200, true, ['token' => $generateToken], 'Login successful');
    }
}
