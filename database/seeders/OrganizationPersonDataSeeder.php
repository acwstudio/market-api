<?php

namespace Database\Seeders;

use Database\Seeders\Traits\ChunkValueSeeder;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class OrganizationPersonDataSeeder extends Seeder
{
    use ChunkValueSeeder;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realOrganizationPersons = \DB::connection('mysql_t')->table('organization_person');
        $testOrganizationPersons = \DB::connection('mysql')->table('organization_person');

        $chunk = $this->chunkValue($testOrganizationPersons->count());

        Schema::disableForeignKeyConstraints();

        $testOrganizationPersons->truncate();

        $this->command->info('Seeding of OrganizationPerson is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realOrganizationPersons->count());

        $this->command->newLine();
        $progressBar->start();

        $realOrganizationPersons->orderBy('organization_id')
            ->chunk($chunk, function ($organizationPersons) use ($testOrganizationPersons, $progressBar) {
                foreach ($organizationPersons as $organizationPerson) {
                    $testOrganizationPerson[] = [
                        'organization_id' => $organizationPerson->organization_id,
                        'person_id'       => $organizationPerson->person_id,
                    ];
                }
                $testOrganizationPersons->insert($testOrganizationPerson);
                $progressBar->advance($organizationPersons->count());
            });

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
