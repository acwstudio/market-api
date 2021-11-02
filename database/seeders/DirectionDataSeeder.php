<?php

namespace Database\Seeders;

use App\Models\Direction;
use Database\Seeders\Traits\ChunkValueSeeder;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class DirectionDataSeeder extends Seeder
{
    use ChunkValueSeeder;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realDirections = \DB::connection('mysql_t')->table('directions');
        $testDirections = \DB::connection('mysql')->table('directions');

        $chunk = $this->chunkValue($realDirections->count());

        Schema::disableForeignKeyConstraints();

        $testDirections->truncate();

        $this->command->info('Seeding of Directions is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realDirections->count());

        $this->command->newLine();
        $progressBar->start();

        $realDirections->orderBy('id')
            ->chunk($chunk, function ($directions) use ($testDirections, $progressBar) {
                foreach ($directions as $direction) {
                    $testDirection[] = [
                        Direction::FIELD_ID            => $direction->id,
                        Direction::FIELD_PUBLISHED     => $direction->published,
                        Direction::FIELD_NAME          => $direction->name,
                        Direction::FIELD_SHOW_MAIN     => $direction->show_main,
                        Direction::FIELD_SORT          => $direction->sort,
                        Direction::FIELD_PREVIEW_IMAGE => $direction->preview_image,
                        Direction::FIELD_SLUG          => $direction->slug,
                        Direction::FIELD_DELETED_AT    => $direction->deleted_at,
                        Direction::FIELD_CREATED_AT    => $direction->created_at,
                        Direction::FIELD_UPDATED_AT    => $direction->updated_at,
                    ];
                }
                $testDirections->insert($testDirection);
                $progressBar->advance($directions->count());
            });

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
