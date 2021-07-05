<?php

namespace App\Core\Error;

interface IError {
   function build(string $code, string $message, Regex $regex, array $field_code) : IError;
   function toArray(): array;
}
