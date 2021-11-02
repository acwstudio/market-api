<?php

namespace Database\Seeders;

use Database\Seeders\Traits\ChunkValueSeeder;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class LandingableDataSeeder extends Seeder
{
    use ChunkValueSeeder;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realLandingables = \DB::connection('mysql_t')->table('landingables');
        $testLandingables = \DB::connection('mysql')->table('landingables');

        $chunk = $this->chunkValue($realLandingables->count());

        Schema::disableForeignKeyConstraints();

        $testLandingables->truncate();

        $this->command->info('Seeding of Landingables is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realLandingables->count());

        $this->command->newLine();
        $progressBar->start();

        $realLandingables->orderBy('landing_id')
            ->chunk($chunk, function ($landingables) use ($testLandingables, $progressBar) {
                foreach ($landingables as $landingable) {
                    $testLandingable[] = [
                        'landing_id'       => $landingable->landing_id,
                        'landingable_id'   => $landingable->landingable_id,
                        'landingable_type' => $landingable->landingable_type,
                    ];
                }
                $testLandingables->insert($testLandingable);
                $progressBar->advance($landingables->count());
            });

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
