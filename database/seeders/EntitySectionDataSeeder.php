<?php

namespace Database\Seeders;

use App\Models\EntitySection;
use Database\Seeders\Traits\ChunkValueSeeder;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class EntitySectionDataSeeder extends Seeder
{
    use ChunkValueSeeder;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realEntitySections = \DB::connection('mysql_t')->table('entity_sections');
        $testEntitySections = \DB::connection('mysql')->table('entity_sections');

        $chunk = $this->chunkValue($realEntitySections->count());

        \Schema::disableForeignKeyConstraints();

        $testEntitySections->truncate();

        $this->command->info('Seeding of EntitySections is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realEntitySections->count());

        $this->command->newLine();
        $progressBar->start();

        $realEntitySections->orderBy('section_id')
            ->chunk($chunk, function ($entitySections) use ($testEntitySections, $progressBar) {
            foreach ($entitySections as $entitySection) {
                $testEntitySection[] = [
                    EntitySection::FIELD_SECTION_ID     => $entitySection->section_id,
                    EntitySection::FIELD_ENTITY_ID      => $entitySection->entity_id,
                    EntitySection::FIELD_ENTITY_TYPE    => $entitySection->entity_type,
                    EntitySection::FIELD_PUBLISHED      => $entitySection->published,
                    EntitySection::FIELD_TITLE          => $entitySection->title,
                    EntitySection::FIELD_ANCHOR_TITLE   => $entitySection->anchor_title,
                    EntitySection::FIELD_IS_HIDE_ANCHOR => $entitySection->is_hide_anchor,
                    EntitySection::FIELD_SORT           => $entitySection->sort,
                    EntitySection::FIELD_JSON           => $entitySection->json,
                    EntitySection::FIELD_CREATED_AT     => $entitySection->created_at,
                    EntitySection::FIELD_UPDATED_AT     => $entitySection->updated_at,
                ];
            }
            $testEntitySections->insert($testEntitySection);
            $progressBar->advance($entitySections->count());
        });

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
