<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productable extends Model
{
    use HasFactory;

    public $table = 'productables';

    const FIELD_PRODUCT_ID = 'product_id',
        FIELD_PRODUCTABLE_ID = 'productable_id',
        FIELD_PRODUCTABLE_TYPE = 'productable_type';

    public $fillable = [
        self::FIELD_PRODUCT_ID,
        self::FIELD_PRODUCTABLE_ID,
        self::FIELD_PRODUCTABLE_TYPE
    ];

    public function getProductId()
    {
        return $this->getAttribute(self::FIELD_PRODUCT_ID);
    }

    public function getProductableId()
    {
        return $this->getAttribute(self::FIELD_PRODUCTABLE_ID);
    }

    public function getProductableType()
    {
        return $this->getAttribute(self::FIELD_PRODUCTABLE_TYPE);
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    public function productable()
    {
        return $this->morphTo();
    }
}
