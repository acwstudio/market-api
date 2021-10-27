<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class OrganizationablesDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realOrganizationables = \DB::connection('mysql_t')->table('organizationables')->get();
        $testOrganizationables = \DB::connection('mysql')->table('organizationables');

        Schema::disableForeignKeyConstraints();

        $testOrganizationables->truncate();

        $this->command->info('Seeding of Organizationables is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realOrganizationables->count());

        $this->command->newLine();
        $progressBar->start();

        foreach ($realOrganizationables as $realOrganizationable) {
            $testOrganizationables->insert([
                'organization_id' => $realOrganizationable->organization_id,
                'organizationable_id' => $realOrganizationable->organizationable_id,
                'organizationable_type' => $realOrganizationable->organizationable_type,
            ]);

            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
