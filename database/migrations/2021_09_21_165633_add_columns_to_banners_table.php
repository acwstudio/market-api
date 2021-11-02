<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->enum('banner_type', ['top', 'narrow', 'side'])->nullable()->after('link');
            $table->string('colour')->nullable()->after('banner_type');
            $table->text('description')->nullable()->after('colour');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->dropColumn('banner_type');
            $table->dropColumn('colour');
            $table->dropColumn('description');
        });
    }
}
