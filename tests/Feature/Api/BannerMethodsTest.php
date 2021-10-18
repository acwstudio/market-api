<?php

namespace Tests\Feature\Api;

use App\Models\Banner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BannerMethodsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @test
     * @return void
     */
    public function get_banner_as_resource_object()
    {
        $banner = Banner::find(1);

        $this->postJson('/api/v1/banners/detail', ["filter" => ["id" => 1]])
            ->assertStatus(200)
            ->assertJson([
                "data" => [
                    "id"              => '1',
                    "type"            => "banners",
                    "published"       => $banner->published,
                    "name"            => $banner->name,
                    "name_second"     => $banner->name_second,
                    "banner_type"     => $banner->banner_type,
                    "color_bg"        => $banner->color_bg,
                    "color_text"      => $banner->color_text,
                    "color_bg_list"   => $banner->color_bg_list,
                    "color_text_list" => $banner->color_text_list,
                    "description"     => $banner->description,
                    "image"           => $banner->image,
                    "created_at"      => $banner->created_at->toJSON(),
                    "updated_at"      => $banner->updated_at->toJSON()
                ]
            ]);
    }

    /**
     * A basic feature test example.
     *
     * @test
     * @return void
     */
    public function get_banners_as_collection_resource_objects() {

        $banners = Banner::all()->take(2);

        $this->postJson('/api/v1/banners/list', ["filter" => []])
            ->assertStatus(200)
            ->assertJson([
                "data" => [
                    [
                        "id"              => '1',
                        "type"            => "banners",
                        "published"       => $banners[0]->published,
                        "name"            => $banners[0]->name,
                        "name_second"     => $banners[0]->name_second,
                        "banner_type"     => $banners[0]->banner_type,
                        "color_bg"        => $banners[0]->color_bg,
                        "color_text"      => $banners[0]->color_text,
                        "color_bg_list"   => $banners[0]->color_bg_list,
                        "color_text_list" => $banners[0]->color_text_list,
                        "description"     => $banners[0]->description,
                        "image"           => $banners[0]->image,
                        "created_at"      => $banners[0]->created_at->toJSON(),
                        "updated_at"      => $banners[0]->updated_at->toJSON()
                    ],
                    [
                        "id"              => '2',
                        "type"            => "banners",
                        "published"       => $banners[1]->published,
                        "name"            => $banners[1]->name,
                        "name_second"     => $banners[1]->name_second,
                        "banner_type"     => $banners[1]->banner_type,
                        "color_bg"        => $banners[1]->color_bg,
                        "color_text"      => $banners[1]->color_text,
                        "color_bg_list"   => $banners[1]->color_bg_list,
                        "color_text_list" => $banners[1]->color_text_list,
                        "description"     => $banners[1]->description,
                        "image"           => $banners[1]->image,
                        "created_at"      => $banners[1]->created_at->toJSON(),
                        "updated_at"      => $banners[1]->updated_at->toJSON()
                    ],
                ]
            ]);
    }

    /**
     * A basic feature test example.
     *
     * @test
     * @return void
     */
    public function get_banners_as_filter_ids_collection_resource_objects() {

        $banners = Banner::findMany([1,2]);

        $this->postJson('/api/v1/banners/list', ["filter" => ["ids" => [1,2]]])
            ->assertStatus(200)
            ->assertJson([
                "data" => [
                    [
                        "id"              => 1,
                        "type"            => "banners",
                        "published"       => $banners[0]->published,
                        "name"            => $banners[0]->name,
                        "name_second"     => $banners[0]->name_second,
                        "banner_type"     => $banners[0]->banner_type,
                        "color_bg"        => $banners[0]->color_bg,
                        "color_text"      => $banners[0]->color_text,
                        "color_bg_list"   => $banners[0]->color_bg_list,
                        "color_text_list" => $banners[0]->color_text_list,
                        "description"     => $banners[0]->description,
                        "image"           => $banners[0]->image,
                        "created_at"      => $banners[0]->created_at->toJSON(),
                        "updated_at"      => $banners[0]->updated_at->toJSON()
                    ],
                    [
                        "id"              => 2,
                        "type"            => "banners",
                        "published"       => $banners[1]->published,
                        "name"            => $banners[1]->name,
                        "name_second"     => $banners[1]->name_second,
                        "banner_type"     => $banners[1]->banner_type,
                        "color_bg"        => $banners[1]->color_bg,
                        "color_text"      => $banners[1]->color_text,
                        "color_bg_list"   => $banners[1]->color_bg_list,
                        "color_text_list" => $banners[1]->color_text_list,
                        "description"     => $banners[1]->description,
                        "image"           => $banners[1]->image,
                        "created_at"      => $banners[1]->created_at->toJSON(),
                        "updated_at"      => $banners[1]->updated_at->toJSON()
                    ],
                ]
            ], true);

    }

    /**
     * A basic feature test example.
     *
     * @test
     * @return void
     */
    public function get_banners_as_filter_published_collection_resource_objects() {

        $banners = Banner::where('published', true)->get();

        $this->postJson('/api/v1/banners/list', ["filter" => ["published" => true]])
            ->assertStatus(200)
            ->assertJson([
                "data" => [
                    [
                        "id"              => 1,
                        "type"            => "banners",
                        "published"       => $banners[0]->published,
                        "name"            => $banners[0]->name,
                        "name_second"     => $banners[0]->name_second,
                        "banner_type"     => $banners[0]->banner_type,
                        "color_bg"        => $banners[0]->color_bg,
                        "color_text"      => $banners[0]->color_text,
                        "color_bg_list"   => $banners[0]->color_bg_list,
                        "color_text_list" => $banners[0]->color_text_list,
                        "description"     => $banners[0]->description,
                        "image"           => $banners[0]->image,
                        "created_at"      => $banners[0]->created_at->toJSON(),
                        "updated_at"      => $banners[0]->updated_at->toJSON()
                    ],
                    [
                        "id"              => 2,
                        "type"            => "banners",
                        "published"       => $banners[1]->published,
                        "name"            => $banners[1]->name,
                        "name_second"     => $banners[1]->name_second,
                        "banner_type"     => $banners[1]->banner_type,
                        "color_bg"        => $banners[1]->color_bg,
                        "color_text"      => $banners[1]->color_text,
                        "color_bg_list"   => $banners[1]->color_bg_list,
                        "color_text_list" => $banners[1]->color_text_list,
                        "description"     => $banners[1]->description,
                        "image"           => $banners[1]->image,
                        "created_at"      => $banners[1]->created_at->toJSON(),
                        "updated_at"      => $banners[1]->updated_at->toJSON()
                    ],
                ]
            ], true);

    }

    /**
     * A basic feature test example.
     *
     * @test
     * @return void
     */
    public function get_banners_as_filter_banner_type_collection_resource_objects() {

        $banners = Banner::where('banner_type', 'narrow')->get();

        $this->postJson('/api/v1/banners/list', ["filter" => ["banner_type" => "narrow"]])
            ->assertStatus(200)
            ->assertJson([
                "data" => [
                    [
                        "id"              => 3,
                        "type"            => "banners",
                        "published"       => $banners[0]->published,
                        "name"            => $banners[0]->name,
                        "name_second"     => $banners[0]->name_second,
                        "banner_type"     => $banners[0]->banner_type,
                        "color_bg"        => $banners[0]->color_bg,
                        "color_text"      => $banners[0]->color_text,
                        "color_bg_list"   => $banners[0]->color_bg_list,
                        "color_text_list" => $banners[0]->color_text_list,
                        "description"     => $banners[0]->description,
                        "image"           => $banners[0]->image,
                        "created_at"      => $banners[0]->created_at->toJSON(),
                        "updated_at"      => $banners[0]->updated_at->toJSON()
                    ]
                ]
            ], true);
    }
}
