<?php

namespace App\Core\Error;

class ErrorManager
{
    /**
     * @var array
     */
    private $errors;

    public function __construct($errors)
    {
        $this->errors = $errors;
    }

    protected function buildError($key, $code, $params = [], $regex = null, $field_code = [])
    {
        $error = $this->errors[$key][$code];
        $message = $this->prepareMessage($error['message'], $params);
        return (new Error())->build($code, $message, $regex, $field_code);
    }

    public function buildInternal($code, $params = [], $regex = null)
    {
        return $this->buildError(ERROR_LEVEL_INTERNAL, $code, $params, $regex);
    }

    static function buildInternalError($code, $params = [], $regex = null)
    {
        return app(ErrorManager::class)->buildInternal($code, $params, $regex);
    }

    public function buildValidate($code, $params = [], $regex = null, $field_code = [])
    {
        return $this->buildError(ERROR_LEVEL_VALIDATE, $code, $params, $regex, $field_code);
    }

    static function buildValidateError($code, $params = [], $regex = null, $field_code = [])
    {
        return app(ErrorManager::class)->buildValidate($code, $params, $regex, $field_code);
    }

    public function buildPrepare($code, $params = [], $regex = null)
    {
        return $this->buildError(ERROR_LEVEL_PREPARE, $code, $params, $regex);
    }

    static function buildPrepareError($code, $params = [], $regex = null)
    {
        return app(ErrorManager::class)->buildPrepare($code, $params, $regex);
    }

    public function buildCalculation($code, $params = [], $regex = null)
    {
        return $this->buildError(ERROR_LEVEL_CALCULATION, $code, $params, $regex);
    }

    static function buildCalculationError($code, $params = [], $regex = null)
    {
        return app(ErrorManager::class)->buildCalculation($code, $params, $regex);
    }

    private function prepareMessage($messageTemplate, $params)
    {
        $message = $messageTemplate;
        foreach ($params as $paramName => $paramValue) {
            $message = str_replace($paramName, $paramValue, $message);
        }
        return $message;
    }
}
