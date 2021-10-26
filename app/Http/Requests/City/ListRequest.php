<?php

declare(strict_types=1);

namespace App\Http\Requests\City;

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
            'filter.ids' => 'array',
            'filter.name' => 'string',
            'filter.region_name' => 'string',
            'filter.city_kladr_id' => 'string',
            'filter.region_kladr_id' => 'string'
        ];
    }
}
