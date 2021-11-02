<?php

namespace Database\Seeders;

use App\Models\ComponentMethod;
use Database\Seeders\Traits\ChunkValueSeeder;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class ComponentMethodDataSeeder extends Seeder
{
    use ChunkValueSeeder;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realComponentMethods = \DB::connection('mysql_t')->table('component_method');
        $testComponentMethods = \DB::connection('mysql')->table('component_method');

        $chunk = $this->chunkValue($realComponentMethods->count());

        Schema::disableForeignKeyConstraints();

        $testComponentMethods->truncate();

        $this->command->info('Seeding of ComponentMethods is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realComponentMethods->count());

        $this->command->newLine();
        $progressBar->start();

        $realComponentMethods->orderBy('component_id')
            ->chunk($chunk, function ($componentMethods) use ($testComponentMethods, $progressBar) {
                foreach ($componentMethods as $componentMethod) {
                    $testComponentMethod[] = [
                        ComponentMethod::FIELD_COMPONENT_ID => $componentMethod->component_id,
                        ComponentMethod::FIELD_METHOD_ID    => $componentMethod->method_id,
                        ComponentMethod::FIELD_DATA         => $componentMethod->data,
                        ComponentMethod::FIELD_CREATED_AT   => $componentMethod->created_at,
                        ComponentMethod::FIELD_UPDATED_AT   => $componentMethod->updated_at,
                    ];
                }
                $testComponentMethods->insert($testComponentMethod);
                $progressBar->advance($componentMethods->count());
            });

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
