<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class ProductablesDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realProductables = \DB::connection('mysql_t')->table('productables')->get();
        $testProductables = \DB::connection('mysql')->table('productables');

        Schema::disableForeignKeyConstraints();

        $testProductables->truncate();

        $this->command->info('Seeding of Productables is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realProductables->count());

        $this->command->newLine();
        $progressBar->start();

        foreach ($realProductables as $realProductable) {
            $testProductables->insert([
                'product_id'       => $realProductable->product_id,
                'productable_id'   => $realProductable->productable_id,
                'productable_type' => $realProductable->productable_type,
            ]);

            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
