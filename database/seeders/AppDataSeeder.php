<?php

namespace Database\Seeders;

use App\Models\App;
use Database\Seeders\Traits\ChunkValueSeeder;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class AppDataSeeder extends Seeder
{
    use ChunkValueSeeder;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realApps = \DB::connection('mysql_t')->table('apps');
        $testApps = \DB::connection('mysql')->table('apps');

        $chunk = $this->chunkValue($realApps->count());

        Schema::disableForeignKeyConstraints();

        $testApps->truncate();

        $this->command->info('Seeding of Apps is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realApps->count());

        $this->command->newLine();
        $progressBar->start();

        $realApps->orderBy('id')->chunk($chunk, function ($apps) use ($testApps, $progressBar) {
            foreach ($apps as $app) {
                $testApp[] = [
                    App::FIELD_ID         => $app->id,
                    App::FIELD_APP        => $app->app,
                    App::FIELD_KEY        => $app->key,
                    App::FIELD_VALUE      => $app->value,
                    App::FIELD_CREATED_AT => $app->created_at,
                    App::FIELD_UPDATED_AT => $app->updated_at,
                    App::FIELD_DELETED_AT => $app->deleted_at,
                ];
            }
            $testApps->insert($testApp);
            $progressBar->advance($apps->count());
        });

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
