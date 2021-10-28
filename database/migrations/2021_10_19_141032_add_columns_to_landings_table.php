<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

final class AddColumnsToLandingsTable extends Migration
{
    public function up(): void
    {
        Schema::table('landings', function (Blueprint $table) {
            $table->boolean('is_all_forms')->default(false)->after('image_src');
            $table->boolean('is_all_levels')->default(false)->after('is_all_forms');
            $table->boolean('is_all_directions')->default(false)->after('is_all_levels');
            $table->boolean('is_all_cities')->default(false)->after('is_all_directions');
            $table->boolean('is_all_organizations')->default(false)->after('is_all_cities');
        });
    }

    public function down(): void
    {
        Schema::table('landings', function (Blueprint $table) {
            $table->dropColumn([
                'is_all_forms',
                'is_all_levels',
                'is_all_directions',
                'is_all_cities',
                'is_all_organizations',
            ]);
        });
    }
}
