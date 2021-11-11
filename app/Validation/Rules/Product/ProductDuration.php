<?php

declare(strict_types=1);

namespace App\Validation\Rules\Product;

use Illuminate\Contracts\Validation\Rule;

final class ProductDuration implements Rule
{
    private string $regexItem = '/^[0-9]+(m|d|h|M|D|H|Y|y)$/';

    public function passes($attribute, $value): bool
    {
        $durationList = explode('-', (string)$value);

        foreach ($durationList as $itemDuration) {
            if (empty($itemDuration)) {
                continue;
            }

            if (!preg_match($this->regexItem, $itemDuration)) {
                return false;
            }
        }

        return true;
    }

    public function message(): string
    {
        return 'Неверный формат';
    }
}
