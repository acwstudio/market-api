<?php

namespace Database\Seeders;

use App\Models\ComponentMethod;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class ComponentMethodDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realComponentMethods = \DB::connection('mysql_t')->table('component_method')->get();
        $testComponentMethods = \DB::connection('mysql')->table('component_method');

        Schema::disableForeignKeyConstraints();

        $testComponentMethods->truncate();

        $this->command->info('Seeding of ComponentMethods is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realComponentMethods->count());

        $this->command->newLine();
        $progressBar->start();

        /** @var ComponentMethod $realComponentMethod */
        foreach ($realComponentMethods as $realComponentMethod) {
            $testComponentMethods->insert([
                ComponentMethod::FIELD_COMPONENT_ID         => $realComponentMethod->component_id,
                ComponentMethod::FIELD_METHOD_ID  => $realComponentMethod->method_id,
                ComponentMethod::FIELD_DATA       => $realComponentMethod->data,
                ComponentMethod::FIELD_CREATED_AT => $realComponentMethod->created_at,
                ComponentMethod::FIELD_UPDATED_AT => $realComponentMethod->updated_at,
            ]);

            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
