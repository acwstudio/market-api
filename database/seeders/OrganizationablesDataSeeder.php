<?php

namespace Database\Seeders;

use Database\Seeders\Traits\ChunkValueSeeder;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class OrganizationablesDataSeeder extends Seeder
{
    use ChunkValueSeeder;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realOrganizationables = \DB::connection('mysql_t')->table('organizationables');
        $testOrganizationables = \DB::connection('mysql')->table('organizationables');

        $chunk = $this->chunkValue($realOrganizationables->count());

        Schema::disableForeignKeyConstraints();

        $testOrganizationables->truncate();

        $this->command->info('Seeding of Organizationables is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realOrganizationables->count());

        $this->command->newLine();
        $progressBar->start();

        $realOrganizationables->orderBy('organization_id')
            ->chunk($chunk, function ($organizationables) use ($testOrganizationables, $progressBar) {
                foreach ($organizationables as $organizationable) {
                    $testOrganizationable[] = [
                        'organization_id'       => $organizationable->organization_id,
                        'organizationable_id'   => $organizationable->organizationable_id,
                        'organizationable_type' => $organizationable->organizationable_type,
                    ];
                }
                $testOrganizationables->insert($testOrganizationable);
                $progressBar->advance($organizationables->count());
            });

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
