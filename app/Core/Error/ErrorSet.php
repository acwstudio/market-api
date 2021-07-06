<?php

namespace App\Core\Error;

class ErrorSet
{
    /**
     * @var array IError
     */
    protected $errors = [];

    /**
     * @param $error
     * @return $this
     */
    public function addError(IError $error)
    {
        array_push($this->errors, $error);
        return $this;
    }

    /**
     * @param $errors
     * @return $this
     */
    public function appendErrors($errors)
    {
        $this->errors = array_merge($this->errors, $errors);
        return $this;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return $this
     */
    public function clean()
    {
        $this->errors = [];
        return $this;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->errors);
    }

    public function toArray()
    {
        if (count($this->errors)) {
            $array = [];
            foreach ($this->errors as $error) {
                /** @var IError */
                $array[] = $error->toArray();
            }
            return $array;
        }
        return [];
    }
}
