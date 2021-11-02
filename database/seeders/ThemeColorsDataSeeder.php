<?php

namespace Database\Seeders;

use App\Models\ThemeColor;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class ThemeColorsDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realThemeColors = \DB::connection('mysql_t')->table('theme_colors')->get();
        $testThemeColors = \DB::connection('mysql')->table('theme_colors');

        Schema::disableForeignKeyConstraints();

        $testThemeColors->truncate();

        $this->command->info('Seeding of ThemeColors is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realThemeColors->count());

        $this->command->newLine();
        $progressBar->start();

        /** @var ThemeColor $realThemeColor */
        foreach ($realThemeColors as $realThemeColor) {
            $testThemeColors->insert([
                ThemeColor::FIELD_ID         => $realThemeColor->id,
                ThemeColor::FIELD_PUBLISHED  => $realThemeColor->published,
                ThemeColor::FIELD_NAME       => $realThemeColor->name,
                ThemeColor::FIELD_KEY        => $realThemeColor->key,
                ThemeColor::FIELD_VALUE      => $realThemeColor->value,
                ThemeColor::FIELD_THEME_ID   => $realThemeColor->theme_id,
                ThemeColor::FIELD_CREATED_AT => $realThemeColor->created_at,
                ThemeColor::FIELD_UPDATED_AT => $realThemeColor->updated_at,
            ]);

            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
