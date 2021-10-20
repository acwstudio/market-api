<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

/**
 * Class Direction
 * @package App\Models
 *
 * @property int $id
 * @property int $published
 * @property string $name
 * @property int $show_main
 * @property int $sort
 * @property string $preview_image
 * @property string $slug
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Direction extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'directions';

    const FILTER_BY = 'direction_ids';
    
    const VALUE_SEARCH = false,
        VALUE_TYPE = 'list';

    const FIELD_ID = 'id',
        FIELD_PUBLISHED = 'published',
        FIELD_NAME = 'name',
        FIELD_SHOW_MAIN = 'show_main',
        FIELD_SORT = 'sort',
        FIELD_PREVIEW_IMAGE = 'preview_image',
        FIELD_SLUG = 'slug',
        FIELD_CREATED_AT = 'created_at',
        FIELD_UPDATED_AT = 'updated_at';

    const ENTITY_RELATIVE_PRODUCT = 'products';

    public $fillable = [
        self::FIELD_PUBLISHED,
        self::FIELD_NAME,
        self::FIELD_SHOW_MAIN,
        self::FIELD_SORT,
        self::FIELD_PREVIEW_IMAGE,
        self::FIELD_SLUG
    ];

    /**
     * @return MorphToMany
     */
    public function products(): MorphToMany
    {
        return $this->morphToMany(Product::class, 'productable');
    }

}
