<?php

namespace Database\Seeders;

use App\Models\App;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class AppDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realApps = \DB::connection('mysql_t')->table('apps')->get();
        $testApps = \DB::connection('mysql')->table('apps');

        Schema::disableForeignKeyConstraints();

        $testApps->truncate();

        $this->command->info('Seeding of Apps is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realApps->count());

        $this->command->newLine();
        $progressBar->start();

        /** @var App $realApp */
        foreach ($realApps as $realApp) {
            $testApps->insert([
                App::FIELD_ID         => $realApp->id,
                App::FIELD_APP        => $realApp->app,
                App::FIELD_KEY        => $realApp->key,
                App::FIELD_VALUE      => $realApp->value,
                App::FIELD_CREATED_AT => $realApp->created_at,
                App::FIELD_UPDATED_AT => $realApp->updated_at,
                App::FIELD_DELETED_AT => $realApp->deleted_at,
            ]);

            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
