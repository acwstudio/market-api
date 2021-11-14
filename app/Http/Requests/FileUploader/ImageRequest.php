<?php

declare(strict_types=1);

namespace App\Http\Requests\FileUploader;

use App\Dto\DtoInterface;
use App\Dto\FileUploader\ImageDto;
use App\Enums\Admin\FileUploader\ImageSourceTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

final class ImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image' => 'required|image',
            'type' => 'required|string|in:' . implode(',', ImageSourceTypeEnum::TYPES_LIST),
        ];
    }

    public function dto(): DtoInterface
    {
        return ImageDto::fromArray($this->all());
    }
}
