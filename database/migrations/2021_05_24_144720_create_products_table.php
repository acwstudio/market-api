<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_moderated')->default(false);
            $table->string('land')->nullable();
            $table->boolean('published');
            $table->string('name');
            $table->string('slug');
            $table->text('preview_image')->nullable();
            $table->text('digital_image')->nullable();
            $table->float('price')->nullable();
            $table->dateTime('start_date')->nullable();

            $table->boolean('is_employment')->default(false);
            $table->boolean('is_installment')->default(false);
            $table->integer('installment_months')->nullable();
            $table->bigInteger('duration')->nullable();

            $table->text('description')->nullable();
            $table->foreignId('organization_id')
                ->references('id')
                ->on('organizations')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('theme_id')
                ->references('id')
                ->on('themes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('category_id')
                ->references('id')
                ->on('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
