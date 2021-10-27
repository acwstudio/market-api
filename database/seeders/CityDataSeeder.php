<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class CityDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realCities = \DB::connection('mysql_t')->table('cities')->get();
        $testCities = \DB::connection('mysql')->table('cities');

        Schema::disableForeignKeyConstraints();

        $testCities->truncate();

        $this->command->info('Seeding of Cities is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realCities->count());

        $this->command->newLine();
        $progressBar->start();

        /** @var City $realCity */
        foreach ($realCities as $realCity) {
            $testCities->insert([
                City::FIELD_ID              => $realCity->id,
                City::FIELD_NAME            => $realCity->name,
                City::FIELD_COUNTRY         => $realCity->country,
                City::FIELD_REGION_NAME     => $realCity->region_name,
                City::FIELD_CITY_KLADR_ID   => $realCity->city_kladr_id,
                City::FIELD_REGION_KLADR_ID => $realCity->region_kladr_id,
                City::FIELD_GEONAME_ID      => $realCity->geoname_id,
                City::FIELD_GEO_POINT       => $realCity->geo_point,
                City::FIELD_CREATED_AT      => $realCity->created_at,
                City::FIELD_UPDATED_AT      => $realCity->updated_at,
            ]);

            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
