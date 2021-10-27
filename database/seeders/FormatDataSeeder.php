<?php

namespace Database\Seeders;

use App\Models\Format;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class FormatDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realFormats = \DB::connection('mysql_t')->table('formats')->get();
        $testFormats = \DB::connection('mysql')->table('formats');

        Schema::disableForeignKeyConstraints();

        $testFormats->truncate();

        $this->command->info('Seeding of Formats is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realFormats->count());

        $this->command->newLine();
        $progressBar->start();

        /** @var Format $realFormat */
        foreach ($realFormats as $realFormat) {
            $testFormats->insert([
                Format::FIELD_ID              => $realFormat->id,
                Format::FIELD_PUBLISHED             => $realFormat->published,
                Format::FIELD_NAME            => $realFormat->name,
                Format::FIELD_SLUG         => $realFormat->slug,
                Format::FIELD_CREATED_AT      => $realFormat->created_at,
                Format::FIELD_UPDATED_AT      => $realFormat->updated_at,
                Format::FIELD_DELETED_AT      => $realFormat->deleted_at,
            ]);

            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
