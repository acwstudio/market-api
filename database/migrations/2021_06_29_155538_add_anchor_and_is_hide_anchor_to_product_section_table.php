<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAnchorAndIsHideAnchorToProductSectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_section', function (Blueprint $table) {
            $table->string('anchor_title')->nullable()->after('title');
            $table->boolean('is_hide_anchor')->default(false)->after('anchor_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_section', function (Blueprint $table) {
            $table->dropColumn('anchor_title');
            $table->dropColumn('is_hide_anchor');
        });
    }
}
