<?php

namespace Database\Seeders;

use App\Models\Direction;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class DirectionDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realDirections = \DB::connection('mysql_t')->table('directions')->get();
        $testDirections = \DB::connection('mysql')->table('directions');

        Schema::disableForeignKeyConstraints();

        $testDirections->truncate();

        $this->command->info('Seeding of Directions is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realDirections->count());

        $this->command->newLine();
        $progressBar->start();

        /** @var Direction $realDirection */
        foreach ($realDirections as $realDirection) {
            $testDirections->insert([
                Direction::FIELD_ID            => $realDirection->id,
                Direction::FIELD_PUBLISHED     => $realDirection->published,
                Direction::FIELD_NAME          => $realDirection->name,
                Direction::FIELD_SHOW_MAIN     => $realDirection->show_main,
                Direction::FIELD_SORT          => $realDirection->sort,
                Direction::FIELD_PREVIEW_IMAGE => $realDirection->preview_image,
                Direction::FIELD_SLUG          => $realDirection->slug,
                Direction::FIELD_DELETED_AT    => $realDirection->deleted_at,
                Direction::FIELD_CREATED_AT    => $realDirection->created_at,
                Direction::FIELD_UPDATED_AT    => $realDirection->updated_at,
            ]);

            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
