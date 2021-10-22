<?php

namespace App\Http\Requests\Subject;

use Illuminate\Foundation\Http\FormRequest;

class ListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'filter.ids' => 'array',
            'filter.published' => 'boolean',
            'filter.name' => 'string',
            'filter.slug' => 'string',
        ];
    }
}
