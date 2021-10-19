<?php

declare(strict_types=1);

namespace App\Http\Requests\Landing;

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
                'exists:landings,id'
            ],
            'filter.name' => 'string',
            'filter.slug' => 'string',
            'filter.description' => 'string',
            'filter.color_bg' => 'string',
            'filter.format_ids' => 'array',
            'filter.level_ids' => 'array',
            'filter.direction_ids' => 'array',
            'filter.city_ids' => 'array',
            'filter.organization_ids' => 'array',
            'include' => 'array',
            'sort' => 'string',
        ];
    }
}
