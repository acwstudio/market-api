<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class OptionDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realOptions = \DB::connection('mysql_t')->table('options')->get();
        $testOptions = \DB::connection('mysql')->table('options');

        Schema::disableForeignKeyConstraints();

        $testOptions->truncate();

        $this->command->info('Seeding of Options is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realOptions->count());

        $this->command->newLine();
        $progressBar->start();

        /** @var Option $realOption */
        foreach ($realOptions as $realOption) {
            $testOptions->insert([
//                Option::FIELD_ID = $realOption->id,
//                Option::FIELD_NAME = $realOption->name,
//                Option::FIELD_SLUG = $realOption->slug,
//                Option::FIELD_VALUE = $realOption->value,
//                Option::FIELD_CREATED_AT = $realOption->created_at,
//                Option::FIELD_UPDATED_AT = $realOption->updated_at
            ]);

//            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

//        $progressBar->finish();
        $this->command->newLine(2);
    }
}
