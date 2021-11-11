<?php

declare(strict_types=1);

namespace App\Dto\SeoTag;

use App\Dto\DtoInterface;

final class SeoTagDto implements DtoInterface
{
    private int|null $id;
    private string|null $model;
    private int|null $modelId;
    private string|null $h1;
    private string|null $title;
    private string|null $keywords;
    private string|null $description;

    public function __construct(
        ?int $id,
        ?string $model,
        ?int $modelId,
        ?string $h1,
        ?string $title,
        ?string $keywords,
        ?string $description
    )
    {
        $this->id = $id;
        $this->model = $model;
        $this->modelId = $modelId;
        $this->h1 = $h1;
        $this->title = $title;
        $this->keywords = $keywords;
        $this->description = $description;
    }

    public static function fromArray(array $arguments): DtoInterface
    {
        return new self(
            $arguments['id'] ?? null,
            $arguments['model'] ?? null,
            $arguments['model_id'] ?? null,
            $arguments['h1'] ?? null,
            $arguments['title'] ?? null,
            $arguments['keywords'] ?? null,
            $arguments['description'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'model' => $this->model,
            'model_id' => $this->modelId,
            'h1' => $this->h1,
            'title' => $this->title,
            'keywords' => $this->keywords,
            'description' => $this->description,
        ];
    }

    public function getModelId(): ?int
    {
        return $this->modelId;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }
}
