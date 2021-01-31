<?php

namespace App\Controllers\Auth;

use App\Controllers\GenerateTokenController;
use App\Repositories\AuthRepository;
use App\Requests\CustomRequestHandler;
use App\Response\CustomResponse;
use App\Validation\AuthValidation;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class RegisterController
 * @package App\Controllers\Auth
 */
class RegisterController
{
    /**
     * @var CustomResponse
     */
    private $customResponse;
    /**
     * @var AuthRepository
     */
    private $authRepository;
    /**
     * @var AuthValidation
     */
    private $authValidation;

    /**
     * RegisterController constructor.
     * @param CustomResponse $customResponse
     * @param AuthRepository $authRepository
     * @param AuthValidation $authValidation
     */
    public function __construct(
        CustomResponse $customResponse,
        AuthRepository $authRepository,
        AuthValidation $authValidation
    )
    {
        $this->customResponse = $customResponse;
        $this->authRepository = $authRepository;
        $this->authValidation = $authValidation;
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param CustomRequestHandler $customRequestHandler
     * @return ResponseInterface
     */
    public function register(RequestInterface $request, ResponseInterface $response, CustomRequestHandler $customRequestHandler): ResponseInterface
    {
        if (!$this->authValidation->register($request)) {
            return $this->customResponse->jsonResponse($response, 400, false, [], $this->authValidation->getErrors());
        }

        $this->authRepository->store([
            'name' => CustomRequestHandler::getParam($request, 'name'),
            'email' => CustomRequestHandler::getParam($request, 'email'),
            'password' => $this->hashPassword(CustomRequestHandler::getParam($request, 'password')),
        ]);

        $generateToken = GenerateTokenController::generateToken($customRequestHandler::getParam($request, 'email'));

        return $this->customResponse->jsonResponse($response, 200, true, ['token' => $generateToken], 'Registration successful');
    }

    /**
     * @param $password
     * @return string
     */
    private function hashPassword($password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
