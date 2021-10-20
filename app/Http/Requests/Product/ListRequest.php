<?php

declare(strict_types=1);

namespace App\Http\Requests\Product;

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
                'exists:products,id'
            ],
            'filter.published' => 'boolean',
            'filter.name' => 'string',
            'filter.slug' => 'string',
            'filter.expiration_date' => 'date',
            'filter.is_document' => 'boolean',
            'filter.is_installment' => 'boolean',
            'filter.is_employment' => 'boolean',
            'filter.organization_ids' => 'array',
            'filter.city_ids' => 'array',
            'filter.subject_ids' => 'array',
            'filter.format_ids' => 'array',
            'filter.level_ids' => 'array',
            'filter.direction_ids' => 'array',
            'filter.person_ids' => 'array',
            'filter.product_place_ids' => 'array',
            'include' => 'array',
            'sort' => 'string',
        ];
    }
}
