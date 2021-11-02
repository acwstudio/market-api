<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntitySectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entity_sections', function (Blueprint $table) {
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('entity_id');
            $table->string('entity_type');
            $table->boolean('published');
            $table->string('title');
            $table->string('anchor_title')->nullable();
            $table->boolean('is_hide_anchor')->nullable();
            $table->integer('sort')->default(100);
            $table->json('json');
            $table->timestamps();

            $table->unique(['section_id', 'entity_id', 'entity_type'], 'unique_entity_sections');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entity_sections');
    }
}
