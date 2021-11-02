<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class PageDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realPages = \DB::connection('mysql_t')->table('pages')->get();
        $testPages = \DB::connection('mysql')->table('pages');

        Schema::disableForeignKeyConstraints();

        $testPages->truncate();

        $this->command->info('Seeding of Pages is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realPages->count());

        $this->command->newLine();
        $progressBar->start();

        /** @var Page $realPage */
        foreach ($realPages as $realPage) {
            $testPages->insert([
                Page::FIELD_ID              => $realPage->id,
                Page::FIELD_NAME            => $realPage->name,
                Page::FIELD_SLUG        => $realPage->slug,
                Page::FIELD_SORT     => $realPage->sort,
                Page::FIELD_PAGE_TYPE   => $realPage->page_type,
                Page::FIELD_ENTITY_TYPE => $realPage->entity_type,
                Page::FIELD_STATIC     => $realPage->static,
                Page::FIELD_DELETED_AT       => $realPage->deleted_at,
                Page::FIELD_CREATED_AT      => $realPage->created_at,
                Page::FIELD_UPDATED_AT      => $realPage->updated_at,
            ]);

            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
