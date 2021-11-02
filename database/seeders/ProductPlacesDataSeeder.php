<?php

namespace Database\Seeders;

use App\Models\ProductPlace;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class ProductPlacesDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realProductPlaces = \DB::connection('mysql_t')->table('product_places')->get();
        $testProductPlaces = \DB::connection('mysql')->table('product_places');

        Schema::disableForeignKeyConstraints();

        $testProductPlaces->truncate();

        $this->command->info('Seeding of ProductPlaces is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realProductPlaces->count());

        $this->command->newLine();
        $progressBar->start();

        /** @var ProductPlace $realProductPlace */
        foreach ($realProductPlaces as $realProductPlace) {
            $testProductPlaces->insert([
                ProductPlace::FIELD_ID         => $realProductPlace->id,
                ProductPlace::FIELD_NAME       => $realProductPlace->name,
                ProductPlace::FIELD_SLUG       => $realProductPlace->slug,
                ProductPlace::FIELD_CREATED_AT => $realProductPlace->created_at,
                ProductPlace::FIELD_UPDATED_AT => $realProductPlace->updated_at,
            ]);

            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
