<?php

namespace Database\Seeders;

use Database\Seeders\Traits\ChunkValueSeeder;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class ComponentPageDataSeeder extends Seeder
{
    use ChunkValueSeeder;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realComponentPages = \DB::connection('mysql_t')->table('component_page');
        $testComponentPages = \DB::connection('mysql')->table('component_page');

        $chunk = $this->chunkValue($realComponentPages->count());

        Schema::disableForeignKeyConstraints();

        $testComponentPages->truncate();

        $this->command->info('Seeding of ComponentPages is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realComponentPages->count());

        $this->command->newLine();
        $progressBar->start();

        $realComponentPages->orderBy('component_id')
            ->chunk($chunk, function ($componentPages) use ($testComponentPages, $progressBar) {
                foreach ($componentPages as $componentPage) {
                    $testComponentPage[] = [
                        'component_id' => $componentPage->component_id,
                        'page_id'      => $componentPage->page_id,
                    ];
                }
                $testComponentPages->insert($testComponentPage);
                $progressBar->advance($componentPages->count());
            });

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
