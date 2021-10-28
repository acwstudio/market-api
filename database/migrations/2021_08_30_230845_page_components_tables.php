<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PageComponentsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('components', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('key')->nullable();
            $table->string('view_type')->nullable();
            $table->timestamps();
        });

        Schema::create('component_page', function (Blueprint $table) {
            $table->foreignId('component_id')
                ->references('id')
                ->on('components')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('page_id')
                ->references('id')
                ->on('pages')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unique(['component_id', 'page_id']);
        });

        Schema::create('methods', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();
        });

        Schema::create('component_method', function (Blueprint $table) {
            $table->foreignId('component_id')
                ->references('id')
                ->on('components')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('method_id')
                ->references('id')
                ->on('methods')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->text('data')->nullable();

            $table->unique(['component_id', 'method_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('components');
        Schema::dropIfExists('component_page');
        Schema::dropIfExists('methods');
        Schema::dropIfExists('component_method');
    }
}
