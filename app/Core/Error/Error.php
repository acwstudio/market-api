<?php

namespace App\Core\Error;

class Error implements IError
{
    protected $code;
    protected $regex;
    protected $message;
    protected $field_code;

    public function build(string $code, string $message, Regex $regex = null, array $field_code = []): IError
    {
        $this->code = $code;
        $this->message = $message;
        $this->regex = $regex ?? new Regex();
        $this->field_code = $field_code;

        return $this;
    }

    public function toArray() : array
    {
        return [
            'code' => $this->code,
            'regex' => $this->regex->toArray(),
            'message' => $this->message,
            'field_code' => $this->field_code
        ];
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code): void
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }


}
