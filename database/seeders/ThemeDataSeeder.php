<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class ThemeDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realThemes = \DB::connection('mysql_t')->table('themes')->get();
        $testThemes = \DB::connection('mysql')->table('themes');

        Schema::disableForeignKeyConstraints();

        $testThemes->truncate();

        $this->command->info('Seeding of Themes is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realThemes->count());

        $this->command->newLine();
        $progressBar->start();

        /** @var Theme $realTheme */
        foreach ($realThemes as $realTheme) {
            $testThemes->insert([
                Theme::FIELD_ID         => $realTheme->id,
                Theme::FIELD_PUBLISHED  => $realTheme->published,
                Theme::FIELD_NAME       => $realTheme->name,
                Theme::FIELD_CREATED_AT => $realTheme->created_at,
                Theme::FIELD_UPDATED_AT => $realTheme->updated_at,
            ]);

            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
