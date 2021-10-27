<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class OrganizationPersonDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realOrganizationPersons = \DB::connection('mysql_t')->table('organization_person')->get();
        $testOrganizationPersons = \DB::connection('mysql')->table('organization_person');

        Schema::disableForeignKeyConstraints();

        $testOrganizationPersons->truncate();

        $this->command->info('Seeding of OrganizationPerson is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realOrganizationPersons->count());

        $this->command->newLine();
        $progressBar->start();

        foreach ($realOrganizationPersons as $realOrganizationPerson) {
            $testOrganizationPersons->insert([
                'organization_id' => $realOrganizationPerson->organization_id,
                'person_id'       => $realOrganizationPerson->person_id,
            ]);

            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
