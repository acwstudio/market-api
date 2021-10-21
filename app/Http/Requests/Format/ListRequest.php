<?php

namespace App\Http\Requests\Format;

use Illuminate\Foundation\Http\FormRequest;

class ListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'filter.ids' => 'array',
            'filter.published' => 'boolean',
            'filter.name' => 'string',
            'filter.show_main' => 'boolean',
            'filter.product_ids' => 'array',
        ];
    }
}
