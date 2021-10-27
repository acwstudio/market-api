<?php

namespace Database\Seeders;

use App\Models\Component;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class ComponentDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realComponents = \DB::connection('mysql_t')->table('components')->get();
        $testComponents = \DB::connection('mysql')->table('components');

        Schema::disableForeignKeyConstraints();

        $testComponents->truncate();

        $this->command->info('Seeding of Components is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realComponents->count());

        $this->command->newLine();
        $progressBar->start();

        /** @var Component $realComponent */
        foreach ($realComponents as $realComponent) {
            $testComponents->insert([
                Component::FIELD_ID         => $realComponent->id,
                Component::FIELD_TITLE      => $realComponent->title,
                Component::FIELD_KEY        => $realComponent->key,
                Component::FIELD_VIEW_TYPE  => $realComponent->view_type,
                Component::FIELD_SORT       => $realComponent->sort,
                Component::FIELD_CREATED_AT => $realComponent->created_at,
                Component::FIELD_UPDATED_AT => $realComponent->updated_at,
            ]);

            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
