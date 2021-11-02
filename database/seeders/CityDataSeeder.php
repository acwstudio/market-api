<?php

namespace Database\Seeders;

use App\Models\City;
use Database\Seeders\Traits\ChunkValueSeeder;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class CityDataSeeder extends Seeder
{
    use ChunkValueSeeder;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realCities = \DB::connection('mysql_t')->table('cities');
        $testCities = \DB::connection('mysql')->table('cities');

        $chunk = $this->chunkValue($realCities->count());

        Schema::disableForeignKeyConstraints();

        $testCities->truncate();

        $this->command->info('Seeding of Cities is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realCities->count());

        $this->command->newLine();
        $progressBar->start();

        $realCities->orderBy('id')->chunk($chunk, function ($cities) use ($testCities, $progressBar) {
            foreach ($cities as $city) {
                $testCity[] = [
                    City::FIELD_ID              => $city->id,
                    City::FIELD_NAME            => $city->name,
                    City::FIELD_COUNTRY         => $city->country,
                    City::FIELD_REGION_NAME     => $city->region_name,
                    City::FIELD_CITY_KLADR_ID   => $city->city_kladr_id,
                    City::FIELD_REGION_KLADR_ID => $city->region_kladr_id,
                    City::FIELD_GEONAME_ID      => $city->geoname_id,
                    City::FIELD_GEO_POINT       => $city->geo_point,
                    City::FIELD_CREATED_AT      => $city->created_at,
                    City::FIELD_UPDATED_AT      => $city->updated_at,
                ];
            }
            $testCities->insert($testCity);
            $progressBar->advance($cities->count());
        });

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
