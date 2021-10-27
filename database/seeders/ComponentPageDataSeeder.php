<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class ComponentPageDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realComponentPages = \DB::connection('mysql_t')->table('component_page')->get();
        $testComponentPages = \DB::connection('mysql')->table('component_page');

        Schema::disableForeignKeyConstraints();

        $testComponentPages->truncate();

        $this->command->info('Seeding of ComponentPages is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realComponentPages->count());

        $this->command->newLine();
        $progressBar->start();

        foreach ($realComponentPages as $realComponentPage) {
            $testComponentPages->insert([
                'component_id' => $realComponentPage->component_id,
                'page_id'      => $realComponentPage->page_id,
            ]);

            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
