<?php


namespace App\Core\Error;


class Regex
{
    private $value;
    private $description;

    public function __construct(string $value = null, string $description = null)
    {
        $this->value = $value;
        $this->description = $description;
    }

    public function toArray(): array
    {
        return [
            'value'       => $this->value,
            'description' => $this->description
        ];
    }
}
