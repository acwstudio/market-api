<?php

namespace Database\Seeders;

use App\Models\Category;
use Database\Seeders\Traits\ChunkValueSeeder;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class CategoryDataSeeder extends Seeder
{
    use ChunkValueSeeder;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realCategories = \DB::connection('mysql_t')->table('categories');
        $testCategories = \DB::connection('mysql')->table('categories');

        $chunk = $this->chunkValue($realCategories->count());

        Schema::disableForeignKeyConstraints();

        $testCategories->truncate();

        $this->command->info('Seeding of Categories is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realCategories->count());

        $this->command->newLine();
        $progressBar->start();

        $realCategories->orderBy('id')
            ->chunk($chunk, function ($categories) use ($testCategories, $progressBar) {
                foreach ($categories as $category) {
                    $testCategory[] = [
                        Category::FIELD_ID         => $category->id,
                        Category::FIELD_PUBLISHED  => $category->published,
                        Category::FIELD_NAME       => $category->name,
                        Category::FIELD_SLUG       => $category->slug,
                        Category::FIELD_DELETED_AT => $category->deleted_at,
                        Category::FIELD_CREATED_AT => $category->created_at,
                        Category::FIELD_UPDATED_AT => $category->updated_at,
                    ];
                }

                $testCategories->insert($testCategory);
                $progressBar->advance($categories->count());
            });

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
