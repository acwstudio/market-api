<?php

declare(strict_types=1);

namespace App\Http\Requests\Direction;

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
            'filter.show_main' => 'int',
            'filter.city_ids' => 'array',
            'filter.product_ids' => 'array',
            'include' => 'array',
            'sort' => 'string',
        ];
    }
}
