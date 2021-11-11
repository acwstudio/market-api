<?php

declare(strict_types=1);

namespace App\Services;

use App\Jobs\Convertors\ConvertImagesWebp;
use Illuminate\Support\Facades\Storage;

final class ImageService
{
    public function getPicturePathFromLoadByProducts(string $picture): bool|string
    {
        $path = Storage::put('uploads/products', $picture);

        dispatch((new ConvertImagesWebp((string)$path))->onQueue('convertWebp'));

        return $path;
    }
}
