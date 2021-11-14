<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\FileUploader\ImageRequest;
use App\Services\ImageService;
use Illuminate\Http\JsonResponse;

final class FileUploaderController extends Controller
{
    private ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function image(ImageRequest $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'path' => $this->imageService->getPicturePath($request->dto()),
            ],
        ]);
    }
}
