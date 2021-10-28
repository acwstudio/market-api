<?php

namespace Database\Seeders;

use App\Models\Component;
use Database\Seeders\Traits\ChunkValueSeeder;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class ComponentDataSeeder extends Seeder
{
    use ChunkValueSeeder;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realComponents = \DB::connection('mysql_t')->table('components');
        $testComponents = \DB::connection('mysql')->table('components');

        $chunk = $this->chunkValue($realComponents->count());

        Schema::disableForeignKeyConstraints();

        $testComponents->truncate();

        $this->command->info('Seeding of Components is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realComponents->count());

        $this->command->newLine();
        $progressBar->start();

        $realComponents->orderBy('id')
            ->chunk($chunk, function ($components) use ($testComponents, $progressBar) {
                foreach ($components as $component) {
                    $testComponent[] = [
                        Component::FIELD_ID         => $component->id,
                        Component::FIELD_TITLE      => $component->title,
                        Component::FIELD_KEY        => $component->key,
                        Component::FIELD_VIEW_TYPE  => $component->view_type,
                        Component::FIELD_SORT       => $component->sort,
                        Component::FIELD_CREATED_AT => $component->created_at,
                        Component::FIELD_UPDATED_AT => $component->updated_at,
                    ];
                }
                $testComponents->insert($testComponent);
                $progressBar->advance($components->count());
            });

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
