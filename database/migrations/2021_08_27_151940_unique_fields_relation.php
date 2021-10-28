<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UniqueFieldsRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('level_product', function (Blueprint $table) {
            $table->unique(['product_id', 'level_id']);
        });

        Schema::table('format_product', function (Blueprint $table) {
            $table->unique(['product_id', 'format_id']);
        });

        Schema::table('direction_product', function (Blueprint $table) {
            $table->unique(['product_id', 'direction_id']);
        });

        Schema::table('product_subject', function (Blueprint $table) {
            $table->unique(['product_id', 'subject_id']);
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('level_product', function (Blueprint $table) {
            $table->dropUnique(['product_id', 'level_id']);
        });

        Schema::table('format_product', function (Blueprint $table) {
            $table->dropUnique(['product_id', 'format_id']);
        });

        Schema::table('direction_product', function (Blueprint $table) {
            $table->dropUnique(['product_id', 'direction_id']);
        });

        Schema::table('product_subject', function (Blueprint $table) {
            $table->dropUnique(['product_id', 'subject_id']);
        });
    }
}
