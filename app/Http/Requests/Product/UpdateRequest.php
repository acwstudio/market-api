<?php

declare(strict_types=1);

namespace App\Http\Requests\Product;

use App\Dto\DtoInterface;
use App\Dto\Product\ProductDto;
use App\Models\Product;
use App\Validation\Rules\Product\ProductDuration;
use Illuminate\Foundation\Http\FormRequest;

final class UpdateRequest extends FormRequest
{
    /**
     * @todo Жесткий костыль для методов админки,
     * после подключения авторизации необходим рефакторинг
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            Product::FIELD_ID => 'required|integer',
            Product::FIELD_NAME => 'string|max:255',
            Product::FIELD_SLUG => 'string|max:255',
            Product::FIELD_START_DATE => 'nullable|date_format:d.m.Y H:i',
            Product::FIELD_EXPIRATION_DATE => 'nullable|date_format:d.m.Y H:i',
            Product::FIELD_BEGIN_DURATION_FORMAT_VALUE => new ProductDuration(),
            Product::FIELD_DURATION_FORMAT_VALUE => new ProductDuration(),
            Product::FIELD_PRICE => 'nullable|numeric',
            Product::FIELD_PREVIEW_IMAGE => 'string|max:255',
            Product::FIELD_DIGITAL_IMAGE => 'string|max:255',
            Product::FIELD_INSTALLMENT_MONTHS => 'nullable|integer',
            Product::FIELD_TRIGGERS => 'required',
            Product::FIELD_COLOR => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            Product::FIELD_START_DATE . '.date_format' => 'Дата имеет неправильный формат (пример: 22.01.2021 08:00)',
            Product::FIELD_NAME => 'Имя введено неверно',
        ];
    }

    public function dto(): DtoInterface
    {
        $beginDurationFormatValue = $this->get('begin_duration_format_value');
        $beginDuration = $this->get('begin_duration');

        return new ProductDto(
            $this->get('id'),
            $this->get('expiration_date'),
            $this->get('sort'),
            (bool)$this->get('published'),
            $this->get('start_date'),
            $this->get('name'),
            $this->get('slug'),
            $this->get('land'),
            $this->get('description'),
            $this->get('price'),
            $this->get('color'),
            $this->get('organization_id'),
            $this->get('category_id'),
            $this->get('persons'),
            $this->get('directions'),
            $this->get('levels'),
            $this->get('formats'),
            $this->get('subjects'),
            $this->get('product_places'),
            (bool)$this->get('is_document'),
            $this->get('document'),
            (bool)$this->get('is_installment'),
            $this->get('installment_months'),
            !is_null($beginDurationFormatValue) ? (string)$beginDurationFormatValue : null,
            $this->get('duration_format_value'),
            (bool)$this->get('is_employment'),
            $this->get('triggers'),
            $this->get('id_origin_product'),
            $this->get('seo_h1'),
            $this->get('seo_title'),
            $this->get('seo_keywords'),
            $this->get('seo_description'),
            $this->get('duration'),
            !is_null($beginDuration) ? (string)$beginDuration : null,
            $this->get('digital_image'),
            $this->get('preview_image'),

            /**
             * @todo обязательный рефакторинг при подключении SYNERGY ID или альтернативной авторизации
             */
            5 // user_id
        );
    }
}
