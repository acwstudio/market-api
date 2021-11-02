<?php

namespace Database\Seeders;

use Database\Seeders\Traits\ChunkValueSeeder;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class ProductablesDataSeeder extends Seeder
{
    use ChunkValueSeeder;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realProductables = \DB::connection('mysql_t')->table('productables');
        $testProductables = \DB::connection('mysql')->table('productables');

        $chunk = $this->chunkValue($realProductables->count());

        Schema::disableForeignKeyConstraints();

        $testProductables->truncate();

        $this->command->info('Seeding of Productables is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realProductables->count());

        $this->command->newLine();
        $progressBar->start();

        $realProductables->orderBy('product_id')
            ->chunk($chunk, function ($productables) use ($testProductables, $progressBar) {
                foreach ($productables as $productable) {
                    $testProductable[] = [
                        'product_id'       => $productable->product_id,
                        'productable_id'   => $productable->productable_id,
                        'productable_type' => $productable->productable_type,
                    ];
                }
                $testProductables->insert($testProductable);
                $progressBar->advance($productables->count());
            });

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
