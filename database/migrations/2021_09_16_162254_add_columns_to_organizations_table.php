<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * description
     * @return void
     */
    public function up()
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->string('site')->nullable()->after('description');
            $table->string('email')->nullable()->after('site');
            $table->string('phone')->nullable()->after('email');

            $table->boolean('is_state')->default(0)->after('phone');
            $table->boolean('is_military_center')->default(0)->after('is_state');
            $table->boolean('is_hostel')->default(0)->after('is_military_center');
            $table->integer('cost_year_study')->nullable()->after('is_hostel');

            $table->integer('budget_places')->nullable()->after('cost_year_study');
            $table->integer('budget_year')->nullable()->after('budget_places');
            $table->float('budget_points')->nullable()->after('budget_year');

            $table->integer('contract_places')->nullable()->after('budget_points');
            $table->integer('contract_year')->nullable()->after('contract_places');
            $table->float('contract_points')->nullable()->after('contract_year');
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
            $table->dropColumn('site');
            $table->dropColumn('email');
            $table->dropColumn('phone');
            $table->dropColumn('is_state');
            $table->dropColumn('is_military_center');
            $table->dropColumn('is_hostel');
            $table->dropColumn('cost_year_study');
            $table->dropColumn('budget_places');
            $table->dropColumn('contract_places');
            $table->dropColumn('budget_year');
            $table->dropColumn('budget_points');
            $table->dropColumn('contract_year');
            $table->dropColumn('contract_points');
        });
    }
}
