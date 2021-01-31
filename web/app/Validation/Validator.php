<?php

namespace App\Validation;

use Respect\Validation\Validator as RespectValidator;
use Respect\Validation\Exceptions\NestedValidationException;
use App\Requests\CustomRequestHandler;

/**
 * Class Validator
 * @package App\Validation
 */
class Validator
{
    /**
     * @var array
     */
    public $errors = [];

    /**
     * @param $request
     * @param array $rules
     * @return $this
     */
    public function validate($request, array $rules): Validator
    {
        foreach ($rules as $field => $rule) {
            try {
                /** @var RespectValidator $value */
                $rule->setName(ucfirst($field))->assert(CustomRequestHandler::getParam($request, $field));
            } catch (NestedValidationException $exception) {
                $this->errors[$field] = $exception->getMessages();
            }
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function failed(): bool
    {
        return !empty($this->errors);
    }
}