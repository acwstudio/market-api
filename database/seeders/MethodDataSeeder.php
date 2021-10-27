<?php

namespace Database\Seeders;

use App\Models\Method;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class MethodDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realMethods = \DB::connection('mysql_t')->table('methods')->get();
        $testMethods = \DB::connection('mysql')->table('methods');

        Schema::disableForeignKeyConstraints();

        $testMethods->truncate();

        $this->command->info('Seeding of Methods is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realMethods->count());

        $this->command->newLine();
        $progressBar->start();

        /** @var Method $realMethod */
        foreach ($realMethods as $realMethod) {
            $testMethods->insert([
                Method::FIELD_ID          => $realMethod->id,
                Method::FIELD_NAME        => $realMethod->name,
                Method::FIELD_URL         => $realMethod->url,
                Method::FIELD_CREATED_AT  => $realMethod->created_at,
                Method::FIELD_UPDATED_AT  => $realMethod->updated_at,
            ]);

            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
