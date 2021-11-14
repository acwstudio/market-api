<?php

declare(strict_types=1);

namespace App\Jobs\Convertors;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use WebPConvert\WebPConvert;

final class ConvertImagesWebp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $file;

    public function __construct(string $file)
    {
        $this->file = $file;
    }

    public function handle(): bool
    {
        $parseOriginPath = explode('/', $this->file);
        $originFileName = $parseOriginPath[count($parseOriginPath) - 1];

        unset($parseOriginPath[count($parseOriginPath) - 1]);

        $directory = implode('/', $parseOriginPath);

        $parseOriginFileName = explode('.', $originFileName);
        $originName = $parseOriginFileName[0];
        $originExpansion = $parseOriginFileName[1];

        if (!in_array($originExpansion, ['jpg', 'png', 'jpeg'])) {
            return true;
        }

        $webpPath = sprintf('%s/%s.webp', $directory, $originName);
        if (Storage::exists($webpPath)) {
            Storage::delete($webpPath);
        }

        $localOriginPath = $this->getCacheImagesPath($originName, $originExpansion);
        $localWebpPath = $this->getCacheImagesPath($originName, 'webp');

        file_put_contents($localOriginPath, Storage::get($this->file));

        if (file_exists($localOriginPath)) {
            WebPConvert::convert($localOriginPath, $localWebpPath, []);
            unlink($localOriginPath);
        }

        if (file_exists($localWebpPath)) {
            Storage::put($webpPath, file_get_contents($localWebpPath));
            unlink($localWebpPath);
        }

        return true;
    }

    protected function getCacheImagesPath(string $name, string $expansion): string
    {
        // @todo Внес правку, нужно проверить, будет ли это все корректно работать на тестовом сервере
        return sprintf(storage_path('framework/cache') . '/images/%s.%s', $name, $expansion);
    }
}
