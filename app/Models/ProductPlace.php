<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPlace extends Model
{
    use HasFactory;

    public $table = 'product_places';

    const MODEL_NAME = 'Место продукта',
        MODEL_LINK = 'product_places';

    const FIELD_ID = 'id',
        FIELD_NAME = 'name',
        FIELD_SLUG = 'slug',
        FIELD_CREATED_AT = 'created_at',
        FIELD_UPDATED_AT = 'updated_at';

    const PART_MESSAGE = 'Место продукта';

    /**
     * @var string[]
     */
    public $fillable = [
        self::FIELD_ID,
        self::FIELD_NAME,
        self::FIELD_SLUG
    ];

    public function getId()
    {
        return $this->getAttribute(self::FIELD_ID);
    }

    public function getName()
    {
        return $this->getAttribute(self::FIELD_NAME);
    }

    public function getSlug()
    {
        return $this->getAttribute(self::FIELD_SLUG);
    }

    public function getCreatedAt()
    {
        return $this->getAttribute(self::FIELD_CREATED_AT);
    }

    public function getUpdatedAt()
    {
        return $this->getAttribute(self::FIELD_UPDATED_AT);
    }

    public function products()
    {
        return $this->morphToMany(Product::class, 'productable');
    }

}
