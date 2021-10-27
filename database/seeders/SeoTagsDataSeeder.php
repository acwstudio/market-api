<?php

namespace Database\Seeders;

use App\Models\SeoTag;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class SeoTagsDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realSeoTags = \DB::connection('mysql_t')->table('seo_tags')->get();
        $testSeoTags = \DB::connection('mysql')->table('seo_tags');

        Schema::disableForeignKeyConstraints();

        $testSeoTags->truncate();

        $this->command->info('Seeding of SeoTags is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realSeoTags->count());

        $this->command->newLine();
        $progressBar->start();

        /** @var SeoTag $realSeoTag */
        foreach ($realSeoTags as $realSeoTag) {
            $testSeoTags->insert([
                SeoTag::FIELD_ID          => $realSeoTag->id,
                SeoTag::FIELD_MODEL       => $realSeoTag->model,
                SeoTag::FIELD_MODEL_ID    => $realSeoTag->model_id,
                SeoTag::FIELD_H1          => $realSeoTag->h1,
                SeoTag::FIELD_TITLE       => $realSeoTag->title,
                SeoTag::FIELD_KEYWORDS    => $realSeoTag->keywords,
                SeoTag::FIELD_DESCRIPTION => $realSeoTag->description,
                SeoTag::FIELD_CREATED_AT  => $realSeoTag->created_at,
                SeoTag::FIELD_UPDATED_AT  => $realSeoTag->updated_at,
            ]);

            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
