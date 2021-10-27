<?php

namespace Database\Seeders;

use App\Models\EntitySection;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class EntitySectionDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realEntitySections = \DB::connection('mysql_t')->table('entity_sections')->get();
        $testEntitySections = \DB::connection('mysql')->table('entity_sections');

        \Schema::disableForeignKeyConstraints();

        $testEntitySections->truncate();

        $this->command->info('Seeding of EntitySections is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realEntitySections->count());

        $this->command->newLine();
        $progressBar->start();

        /** @var EntitySection $realEntitySection */
        foreach ($realEntitySections as $realEntitySection) {
            $testEntitySections->insert([
                EntitySection::FIELD_SECTION_ID     => $realEntitySection->section_id,
                EntitySection::FIELD_ENTITY_ID      => $realEntitySection->entity_id,
                EntitySection::FIELD_ENTITY_TYPE    => $realEntitySection->entity_type,
                EntitySection::FIELD_PUBLISHED      => $realEntitySection->published,
                EntitySection::FIELD_TITLE          => $realEntitySection->title,
                EntitySection::FIELD_ANCHOR_TITLE   => $realEntitySection->anchor_title,
                EntitySection::FIELD_IS_HIDE_ANCHOR => $realEntitySection->is_hide_anchor,
                EntitySection::FIELD_SORT           => $realEntitySection->sort,
                EntitySection::FIELD_JSON           => $realEntitySection->json,
                EntitySection::FIELD_CREATED_AT     => $realEntitySection->created_at,
                EntitySection::FIELD_UPDATED_AT     => $realEntitySection->updated_at,
            ]);

            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
