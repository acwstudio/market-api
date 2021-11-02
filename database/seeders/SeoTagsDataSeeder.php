<?php

namespace Database\Seeders;

use App\Models\SeoTag;
use Database\Seeders\Traits\ChunkValueSeeder;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class SeoTagsDataSeeder extends Seeder
{
    use ChunkValueSeeder;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realSeoTags = \DB::connection('mysql_t')->table('seo_tags');
        $testSeoTags = \DB::connection('mysql')->table('seo_tags');

        $chunk = $this->chunkValue($realSeoTags->count());

        Schema::disableForeignKeyConstraints();

        $testSeoTags->truncate();

        $this->command->info('Seeding of SeoTags is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realSeoTags->count());

        $this->command->newLine();
        $progressBar->start();

        $realSeoTags->orderBy('id')
            ->chunk($chunk, function ($seoTags) use ($testSeoTags, $progressBar) {
                foreach ($seoTags as $seoTag) {
                    $testSeoTag[] = [
                        SeoTag::FIELD_ID          => $seoTag->id,
                        SeoTag::FIELD_MODEL       => $seoTag->model,
                        SeoTag::FIELD_MODEL_ID    => $seoTag->model_id,
                        SeoTag::FIELD_H1          => $seoTag->h1,
                        SeoTag::FIELD_TITLE       => $seoTag->title,
                        SeoTag::FIELD_KEYWORDS    => $seoTag->keywords,
                        SeoTag::FIELD_DESCRIPTION => $seoTag->description,
                        SeoTag::FIELD_CREATED_AT  => $seoTag->created_at,
                        SeoTag::FIELD_UPDATED_AT  => $seoTag->updated_at,
                    ];
                }
                $testSeoTags->insert($testSeoTag);
                $progressBar->advance($seoTags->count());
            });

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
