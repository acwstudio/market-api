<?php

namespace App\Http\Requests\City;

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
            'filter.name' => 'string',
            'filter.region_name' => 'string',
            'filter.city_kladr_id' => 'string',
            'filter.region_kladr_id' => 'string'
        ];
    }
}
