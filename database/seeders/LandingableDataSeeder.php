<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class LandingableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realLandingables = \DB::connection('mysql_t')->table('landingables')->get();
        $testLandingables = \DB::connection('mysql')->table('landingables');

        Schema::disableForeignKeyConstraints();

        $testLandingables->truncate();

        $this->command->info('Seeding of Landingables is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realLandingables->count());

        $this->command->newLine();
        $progressBar->start();

        foreach ($realLandingables as $realLandingable) {

            $testLandingables->insert([
                'landing_id'       => $realLandingable->landing_id,
                'landingable_id'   => $realLandingable->landingable_id,
                'landingable_type' => $realLandingable->landingable_type,
            ]);

            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
