<?php

declare(strict_types=1);

namespace App\Http\Requests\Quiz;

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
            'filter.published' => 'boolean',
            'include'          => 'array',
            'sort'             => 'string',
        ];
    }
}
