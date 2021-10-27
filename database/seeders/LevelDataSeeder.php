<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class LevelDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realLevels = \DB::connection('mysql_t')->table('levels')->get();
        $testLevels = \DB::connection('mysql')->table('levels');

        Schema::disableForeignKeyConstraints();

        $testLevels->truncate();

        $this->command->info('Seeding of Levels is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realLevels->count());

        $this->command->newLine();
        $progressBar->start();

        /** @var Level $realLevel */
        foreach ($realLevels as $realLevel) {
            $testLevels->insert([
                Level::FIELD_ID         => $realLevel->id,
                Level::FIELD_PUBLISHED  => $realLevel->published,
                Level::FIELD_NAME       => $realLevel->name,
                Level::FIELD_SLUG       => $realLevel->slug,
                Level::FIELD_CREATED_AT => $realLevel->created_at,
                Level::FIELD_UPDATED_AT => $realLevel->updated_at,
                Level::FIELD_DELETED_AT => $realLevel->deleted_at,
            ]);

            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
