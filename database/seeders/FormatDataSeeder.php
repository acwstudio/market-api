<?php

namespace Database\Seeders;

use App\Models\Format;
use Database\Seeders\Traits\ChunkValueSeeder;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class FormatDataSeeder extends Seeder
{
    use ChunkValueSeeder;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realFormats = \DB::connection('mysql_t')->table('formats');
        $testFormats = \DB::connection('mysql')->table('formats');

        $chunk = $this->chunkValue($realFormats->count());

        Schema::disableForeignKeyConstraints();

        $testFormats->truncate();

        $this->command->info('Seeding of Formats is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realFormats->count());

        $this->command->newLine();
        $progressBar->start();

        $realFormats->orderBy('id')
            ->chunk($chunk, function ($formats) use ($testFormats, $progressBar) {
                foreach ($formats as $format) {
                    $testFormat[] = [
                        Format::FIELD_ID         => $format->id,
                        Format::FIELD_PUBLISHED  => $format->published,
                        Format::FIELD_NAME       => $format->name,
                        Format::FIELD_SLUG       => $format->slug,
                        Format::FIELD_CREATED_AT => $format->created_at,
                        Format::FIELD_UPDATED_AT => $format->updated_at,
                        Format::FIELD_DELETED_AT => $format->deleted_at,
                    ];
                }
                $testFormats->insert($testFormat);
                $progressBar->advance();
            });

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
