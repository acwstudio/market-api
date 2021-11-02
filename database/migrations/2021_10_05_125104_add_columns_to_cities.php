<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToCities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->string('country')->after('id');
            $table->string('geoname_id')->unique()->after('region_kladr_id');
            $table->string('city_kladr_id')->unique()->nullable()->change();
            $table->string('region_kladr_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->dropColumn('country');
            $table->dropColumn('geoname_id');
            $table->dropUnique(['city_kladr_id']);
            $table->string('city_kladr_id')->nullable(false)->change();
            $table->string('region_kladr_id')->nullable(false)->change();
        });
    }
}
