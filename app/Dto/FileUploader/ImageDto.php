<?php

declare(strict_types=1);

namespace App\Dto\FileUploader;

use App\Dto\DtoInterface;
use Illuminate\Http\UploadedFile;

final class ImageDto implements DtoInterface
{
    private UploadedFile $image;

    private string $type;

    public function __construct(UploadedFile $image, string $type)
    {
        $this->image = $image;
        $this->type = $type;
    }

    public static function fromArray(array $arguments): DtoInterface
    {
        return new self(
            $arguments['image'],
            $arguments['type']
        );
    }

    public function toArray(): array
    {
        return [
            'image' => $this->image,
            'type' => $this->type,
        ];
    }

    public function getImage(): UploadedFile
    {
        return $this->image;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
