<?php

declare(strict_types=1);

namespace App\Http\Requests\EntitySection;

use Illuminate\Foundation\Http\FormRequest;

final class DetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'filter.section_id' => 'required|integer',
            'filter.entity_id' => 'required|integer',
            'filter.entity_type' => 'required|string',
        ];
    }

    protected function passedValidation(): void
    {
        $data = $this->all();
        $data['filter']['entity_type'] = 'App\\Models\\' . ucfirst($data['filter']['entity_type']);
        $this->merge($data);
    }
}
