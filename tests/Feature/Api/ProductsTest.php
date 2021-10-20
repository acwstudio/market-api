<?php

declare(strict_types=1);

namespace Tests\Feature\Api;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Tests\TestCase;

final class ProductsTest extends TestCase
{
    public function test_list(): void
    {
        $product = Product::first();

        $model = app(Product::class);
        $query = $model->newQuery()
            ->where('id', $product->id)
            ->paginate(10, ['*'], 'page', 1);

        $productCollection = new ProductCollection($query);

        /*
         * @todo костыль с json_decode(collection->toJson()) связан с тем, что метод collection->toArray(Request)
         * в качестве аргумента принимает Request. Нужно подумать, как можно сделать красивее
         */
        $this->postJson('/api/v1/products/list', ['filter' => ['ids' => [$product->id]]])
            ->assertStatus(200)
            ->assertJson([
                'data' => json_decode($productCollection->toJson(), true),
                'success' =>true,
                'count' => $query->total(),
            ]);
    }

    public function test_detail(): void
    {
        $product = Product::first();

        $productResource = (new ProductResource($product))->toJson();

        /*
         * @todo костыль с json_decode(collection->toJson()) связан с тем, что метод collection->toArray(Request)
         * в качестве аргумента принимает Request. Нужно подумать, как можно сделать красивее
         */
        $this->postJson('/api/v1/products/detail', ['filter' => ['id' => $product->id, 'slug' => $product->slug]])
            ->assertStatus(200)
            ->assertJson([
                'data' => json_decode($productResource, true),
                'success' => true
            ]);
    }
}
