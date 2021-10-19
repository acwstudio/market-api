<?php

declare(strict_types=1);

namespace App\Http\Requests\Organization;

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
                'exists:organizations,id'
            ],
            'filter.published' => 'boolean',
            'filter.name' => 'string',
            'filter.slug' => 'string',
            'filter.land' => 'string',
            'filter.parent_id' => 'int',
            'filter.city_ids' => 'array',
            'filter.direction_ids' => 'array',
            'filter.level_ids' => 'array',
            'filter.format_ids' => 'array',
            'filter.product_ids' => 'array',
            'filter.person_ids' => 'array',
            'include' => 'array',
            'sort' => 'string',
        ];
    }
}
