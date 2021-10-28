<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrganizations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->text('subtitle')->nullable()->after('slug');
            $table->text('description')->nullable()->after('subtitle');
            $table->longText('html_body')->nullable()->after('description');
            $table->text('classes')->nullable()->after('html_body');
            $table->text('logo_code')->nullable()->after('classes');
            $table->text('color_code_titles')->nullable()->after('logo_code');
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
            $table->dropColumn('subtitle');
            $table->dropColumn('description');
            $table->dropColumn('html_body');
            $table->dropColumn('classes');
            $table->dropColumn('logo_code');
            $table->dropColumn('color_code_titles');
        });
    }
}
