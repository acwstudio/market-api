<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\FileUploader\ImageDto;
use App\Jobs\Convertors\ConvertImagesWebp;
use Illuminate\Support\Facades\Storage;

final class ImageService
{
    /*
     * @todo перенес сервис логику обработки изображений с монолита в api, требуется рефакторинг
     */
    public function getPicturePath(ImageDto $dto): bool|string
    {
        $path = Storage::put('uploads/' . $dto->getType(), $dto->getImage());

        dispatch((new ConvertImagesWebp((string)$path))->onQueue('convertWebp'));

        return $path;
    }
}
