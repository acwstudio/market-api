<?php

declare(strict_types=1);

namespace App\Http\Requests\Person;

use Illuminate\Foundation\Http\FormRequest;

final class ListRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'filter.ids' => [
                'array',
                'exists:persons,id'
            ],
            'filter.published' => 'boolean',
            'filter.name' => 'string',
            'filter.show_main' => 'boolean',
            'filter.product_ids' => 'array',
            'sort' => 'string',
        ];
    }
}
