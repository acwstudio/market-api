<?php

declare(strict_types=1);

namespace App\Dto\Product;

use App\Dto\DtoInterface;
use App\Models\Product;

final class ProductDto implements DtoInterface
{
    private int|null $id;
    private string|null $expirationDate;
    private int|null $sort;
    private bool|null $published;
    private string|null $startDate;
    private string|null $name;
    private string|null $slug;
    private string|null $land;
    private string|null $description;
    private float|null $price;
    private string|null $color;
    private int|null $organizationId;
    private int|null $categoryId;
    private array|null $persons;
    private array|null $directions;
    private array|null $levels;
    private array|null $formats;
    private array|null $subjects;
    private array|null $productPlaces;
    private bool|null $isDocument;
    private int|null $document;
    private bool|null $isInstallment;
    private int|null $installmentMonths;
    private string|bool $beginDurationFormatValue;
    private string|null $durationFormatValue;
    private bool|null $isEmployment;
    private string|null $triggers;
    private int|null $idOriginProduct;
    private string|null $seoH1;
    private string|null $seoTitle;
    private string|null $seoKeywords;
    private string|null $seoDescription;
    private int|null $duration;
    private string|bool $beginDuration;
    private string|null $previewImage;
    private string|null $digitalImage;
    private int $userId;
    private Product|null $eloquent;

    public function __construct(
        ?int $id,
        ?string $expirationDate,
        ?int $sort,
        ?bool $published,
        ?string $startDate,
        ?string $name,
        ?string $slug,
        ?string $land,
        ?string $description,
        ?float $price,
        ?string $color,
        ?int $organizationId,
        ?int $categoryId,
        ?array $persons,
        ?array $directions,
        ?array $levels,
        ?array $formats,
        ?array $subjects,
        ?array $productPlaces,
        ?bool $isDocument,
        ?int $document,
        ?bool $isInstallment,
        ?int $installmentMonths,
        string|bool $beginDurationFormatValue,
        ?string $durationFormatValue,
        ?bool $isEmployment,
        ?string $triggers,
        ?int $idOriginProduct,
        ?string $seoH1,
        ?string $seoTitle,
        ?string $seoKeywords,
        ?string $seoDescription,
        ?int $duration,
        string|bool $beginDuration,
        ?string $previewImage,
        ?string $digitalImage,
        int $userId
    )
    {
        $this->id = $id;
        $this->expirationDate = $expirationDate;
        $this->sort = $sort;
        $this->published = $published;
        $this->startDate = $startDate;
        $this->name = $name;
        $this->slug = $slug;
        $this->land = $land;
        $this->description = $description;
        $this->price = $price;
        $this->color = $color;
        $this->organizationId = $organizationId;
        $this->categoryId = $categoryId;
        $this->persons = $persons;
        $this->directions = $directions;
        $this->levels = $levels;
        $this->formats = $formats;
        $this->subjects = $subjects;
        $this->productPlaces = $productPlaces;
        $this->isDocument = $isDocument;
        $this->document = $document;
        $this->isInstallment = $isInstallment;
        $this->installmentMonths = $installmentMonths;
        $this->beginDurationFormatValue = $beginDurationFormatValue;
        $this->durationFormatValue = $durationFormatValue;
        $this->isEmployment = $isEmployment;
        $this->triggers = $triggers;
        $this->idOriginProduct = $idOriginProduct;
        $this->seoH1 = $seoH1;
        $this->seoTitle = $seoTitle;
        $this->seoKeywords = $seoKeywords;
        $this->seoDescription = $seoDescription;
        $this->duration = $duration;
        $this->beginDuration = $beginDuration;
        $this->previewImage = $previewImage;
        $this->digitalImage = $digitalImage;
        $this->userId = $userId;
    }

    public static function fromArray(array $arguments): DtoInterface
    {
        return new self(
            $arguments['id'] ?? null,
            $arguments['expiration_date'] ?? null,
            $arguments['sort'] ?? null,
            $arguments['published'] ?? null,
            $arguments['start_date'] ?? null,
            $arguments['name'] ?? null,
            $arguments['slug'] ?? null,
            $arguments['land'] ?? null,
            $arguments['description'] ?? null,
            $arguments['price'] ?? null,
            $arguments['color'] ?? null,
            $arguments['organization_id'] ?? null,
            $arguments['category_id'] ?? null,
            $arguments['persons'] ?? null,
            $arguments['directions'] ?? null,
            $arguments['levels'] ?? null,
            $arguments['formats'] ?? null,
            $arguments['subjects'] ?? null,
            $arguments['product_places'] ?? null,
            $arguments['is_document'] ?? null,
            $arguments['document'] ?? null,
            $arguments['is_installment'] ?? null,
            $arguments['installment_months'] ?? null,
            $arguments['begin_duration_format_value'] ?? null,
            $arguments['duration_format_value'] ?? null,
            $arguments['is_employment'] ?? null,
            $arguments['triggers'] ?? null,
            $arguments['idOriginProduct'] ?? null,
            $arguments['seo_h1'] ?? null,
            $arguments['seo_title'] ?? null,
            $arguments['seo_keywords'] ?? null,
            $arguments['seo_description'] ?? null,
            $arguments['duration'] ?? null,
            $arguments['begin_duration'] ?? null,
            $arguments['digital_image'] ?? null,
            $arguments['preview_image'] ?? null,
            $arguments['user_id']
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'expiration_date' => $this->expirationDate,
            'sort' => $this->sort,
            'published' => $this->published,
            'start_date' => $this->startDate,
            'name' => $this->name,
            'slug' => $this->slug,
            'land' => $this->land,
            'description' => $this->description,
            'price' => $this->price,
            'color' => $this->color,
            'organization_id' => $this->organizationId,
            'category_id' => $this->categoryId,
            'persons' => $this->persons,
            'directions' => $this->directions,
            'levels' => $this->levels,
            'formats' => $this->formats,
            'subjects' => $this->subjects,
            'product_places' => $this->productPlaces,
            'is_document' => $this->isDocument,
            'document' => $this->document,
            'is_installment' => $this->isInstallment,
            'installment_months' => $this->installmentMonths,
            'begin_duration_format_value' => $this->beginDurationFormatValue,
            'duration_format_value' => $this->durationFormatValue,
            'is_employment' => $this->isEmployment,
            'triggers' => $this->triggers,
            'id_origin_product' => $this->idOriginProduct,
            'seo_h1' => $this->seoH1,
            'seo_title' => $this->seoTitle,
            'seo_keywords' => $this->seoKeywords,
            'seo_description' => $this->seoDescription,
            'duration' => $this->duration,
            'begin_duration' => $this->beginDuration,
            'preview_image' => $this->previewImage,
            'digital_image' => $this->digitalImage,
            'user_id' => $this->userId,
        ];
    }

    public function getEloquent(): Product
    {
        return $this->eloquent;
    }

    public function setEloquent(Product $product): self
    {
        $this->eloquent = $product;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getDirections(): ?array
    {
        return $this->directions;
    }

    public function getFormats(): ?array
    {
        return $this->formats;
    }

    public function getLevels(): ?array
    {
        return $this->levels;
    }

    public function getSubjects(): ?array
    {
        return $this->subjects;
    }

    public function getPersons(): ?array
    {
        return $this->persons;
    }

    public function getProductPlaces(): ?array
    {
        return $this->productPlaces;
    }

    public function getSeoH1(): ?string
    {
        return $this->seoH1;
    }

    public function getSeoTitle(): ?string
    {
        return $this->seoTitle;
    }

    public function getSeoKeywords(): ?string
    {
        return $this->seoKeywords;
    }

    public function getSeoDescription(): ?string
    {
        return $this->seoDescription;
    }

    public function setPreviewImage(string $previewImage): self
    {
        $this->previewImage = $previewImage;

        return $this;
    }

    public function setDigitalImage(string $digitalImage): self
    {
        $this->digitalImage = $digitalImage;

        return $this;
    }

    public function getIdOriginProduct(): ?int
    {
        return $this->idOriginProduct;
    }
}
