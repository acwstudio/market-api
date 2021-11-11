<?php

declare(strict_types=1);

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

final class DeleteRequest extends FormRequest
{
    /**
     * @todo Жесткий костыль для методов админки,
     * после подключения авторизации необходим рефакторинг
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'integer',
            ],
        ];
    }
}
