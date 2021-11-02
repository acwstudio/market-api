<?php

namespace Database\Seeders;

use App\Models\Method;
use Database\Seeders\Traits\ChunkValueSeeder;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class MethodDataSeeder extends Seeder
{
    use ChunkValueSeeder;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realMethods = \DB::connection('mysql_t')->table('methods');
        $testMethods = \DB::connection('mysql')->table('methods');

        $chunk = $this->chunkValue($realMethods->count());

        Schema::disableForeignKeyConstraints();

        $testMethods->truncate();

        $this->command->info('Seeding of Methods is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realMethods->count());

        $this->command->newLine();
        $progressBar->start();

        $realMethods->orderBy('id')
            ->chunk($chunk, function ($methods) use ($testMethods, $progressBar) {
                foreach ($methods as $method) {
                    $testMethod[] = [
                        Method::FIELD_ID          => $method->id,
                        Method::FIELD_NAME        => $method->name,
                        Method::FIELD_URL         => $method->url,
                        Method::FIELD_CREATED_AT  => $method->created_at,
                        Method::FIELD_UPDATED_AT  => $method->updated_at,
                    ];
                }
                $testMethods->insert($testMethod);
                $progressBar->advance($methods->count());
            });

        /** @var Method $realMethod */
        foreach ($realMethods as $realMethod) {
            $testMethods->insert([

            ]);


        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
