<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAbbreviationNameColumnToOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->string('abbreviation_name')->nullable()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->dropColumn('abbreviation_name');
        });
    }
}
