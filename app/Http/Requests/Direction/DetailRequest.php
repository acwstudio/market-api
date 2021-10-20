<?php

declare(strict_types=1);

namespace App\Http\Requests\Direction;

use Illuminate\Foundation\Http\FormRequest;

class DetailRequest extends FormRequest
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
            'filter' => 'required|array',
            'filter.id' => [
                function ($attr, $value, $fail) {
                    if (request()->has($attr) === request()->filled('filter.slug')) {
                        return $fail('Only 1 of the two is allowed');
                    }
                },
            ],
            'filter.slug' => 'required_without:filter.id'
        ];
    }
}
