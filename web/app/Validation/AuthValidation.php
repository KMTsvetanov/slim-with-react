<?php

namespace App\Validation;

use App\Models\User;
use App\Requests\CustomRequestHandler;
use DI\Container;
use Psr\Http\Message\RequestInterface;
use Respect\Validation\Validator as v;

/**
 * Class AuthValidation
 * @package App\Validation
 */
class AuthValidation
{
    /**
     * @var Validator
     */
    private $validator;
    /**
     * @var array
     */
    private $errors = [];
    /**
     * @var Container
     */
    private $container;
    /**
     * @var User
     */
    private $user;
    /**
     * @var CustomRequestHandler
     */
    private $customRequestHandler;

    /**
     * AuthValidation constructor.
     * @param User $user
     * @param Validator $validator
     * @param Container $container
     * @param CustomRequestHandler $customRequestHandler
     */
    public function __construct(User $user, Validator $validator, Container $container, CustomRequestHandler $customRequestHandler)
    {
        $this->user = $user;
        $this->validator = $validator;
        $this->container = $container;
        $this->customRequestHandler = $customRequestHandler;
    }

    /**
     * @param RequestInterface $request
     * @return bool
     */
    public function register(RequestInterface $request): bool
    {
        $this->validator->validate($request, [
            'name' => v::notEmpty()->length(5, 25),
            'email' => v::notEmpty()->length(5, 255)->email(),
            'password' => v::notEmpty()->length(5, 255)->noWhitespace(),
        ]);

        if ($this->validator->failed()) {
            $this->setErrors($this->validator->errors);

            return false;
        }

        if ($this->user->where(['email' => $this->customRequestHandler::getParam($request, 'email')])->exists()) {
            $this->setErrors(['email' => ['Email' => 'Email is Taken']]);

            return false;
        }
        return true;
    }

    /**
     * @param RequestInterface $request
     * @return bool
     */
    public function login(RequestInterface $request): bool
    {
        $this->validator->validate($request, [
            'email' => v::notEmpty()->length(5, 255)->email(),
            'password' => v::notEmpty()->length(5, 255)->noWhitespace(),
        ]);

        if ($this->validator->failed()) {
            $this->setErrors($this->validator->errors);

            return false;
        }

        if (!$this->verifyAccount(
            $this->customRequestHandler::getParam($request, 'email'),
            $this->customRequestHandler::getParam($request, 'password'),
        )) {
            $this->setErrors(['password' => ['password' => 'Invalid email/password combination']]);

            return false;
        }

        return true;
    }

    /**
     * @param $email
     * @param $password
     * @return bool
     */
    private function verifyAccount($email, $password): bool
    {
        $user = $this->user->where(['email' => $email])->first();

        if (is_null($user)) {
            return false;
        }

        return password_verify($password, $user->password);
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors(array $errors): void
    {
        $this->errors = $errors;
    }
}