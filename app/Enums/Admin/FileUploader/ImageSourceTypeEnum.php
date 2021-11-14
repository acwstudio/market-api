<?php

declare(strict_types=1);

namespace App\Enums\Admin\FileUploader;

final class ImageSourceTypeEnum
{
    public const PRODUCT_IMAGES = 'products';

    public const TYPES_LIST = [
        self::PRODUCT_IMAGES,
    ];
}
