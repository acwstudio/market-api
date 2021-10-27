<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class CategoryDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realCategories = \DB::connection('mysql_t')->table('categories')->get();
        $testCategories = \DB::connection('mysql')->table('categories');

        Schema::disableForeignKeyConstraints();

        $testCategories->truncate();

        $this->command->info('Seeding of Categories is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realCategories->count());

        $this->command->newLine();
        $progressBar->start();

        /** @var Category $realCategory */
        foreach ($realCategories as $realCategory) {
            $testCategories->insert([
                Category::FIELD_ID         => $realCategory->id,
                Category::FIELD_PUBLISHED  => $realCategory->published,
                Category::FIELD_NAME       => $realCategory->name,
                Category::FIELD_SLUG       => $realCategory->slug,
                Category::FIELD_DELETED_AT => $realCategory->deleted_at,
                Category::FIELD_CREATED_AT => $realCategory->created_at,
                Category::FIELD_UPDATED_AT => $realCategory->updated_at,
            ]);

            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
