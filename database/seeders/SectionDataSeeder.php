<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class SectionDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realSections = \DB::connection('mysql_t')->table('sections')->get();
        $testSections = \DB::connection('mysql')->table('sections');

        Schema::disableForeignKeyConstraints();

        $testSections->truncate();

        $this->command->info('Seeding of Sections is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realSections->count());

        $this->command->newLine();
        $progressBar->start();

        /** @var Section $realSection */
        foreach ($realSections as $realSection) {
            $testSections->insert([
                Section::FIELD_ID             => $realSection->id,
                Section::FIELD_PUBLISHED      => $realSection->published,
                Section::FIELD_NAME           => $realSection->name,
                Section::FIELD_IS_GLOBAL      => $realSection->is_global,
                Section::FIELD_CONFIG_KEY     => $realSection->config_key,
                Section::FIELD_API_KEY        => $realSection->api_key,
                Section::FIELD_PREVIEW_IMAGE  => $realSection->preview_image,
                Section::FIELD_GROUP          => $realSection->group,
                Section::FIELD_JSON_TEMPLATE  => $realSection->json_template,
                Section::FIELD_CREATED_AT     => $realSection->created_at,
                Section::FIELD_UPDATED_AT     => $realSection->updated_at,
            ]);

            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
