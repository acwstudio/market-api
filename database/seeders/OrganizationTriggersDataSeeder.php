<?php

namespace Database\Seeders;

use App\Models\OrganizationTrigger;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class OrganizationTriggersDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realOrganizationTriggers = \DB::connection('mysql_t')->table('organization_triggers')->get();
        $testOrganizationTriggers = \DB::connection('mysql')->table('organization_triggers');

        Schema::disableForeignKeyConstraints();

        $testOrganizationTriggers->truncate();

        $this->command->info('Seeding of OrganizationTriggers is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realOrganizationTriggers->count());

        $this->command->newLine();
        $progressBar->start();

        /** @var OrganizationTrigger $realOrganizationTrigger */
        foreach ($realOrganizationTriggers as $realOrganizationTrigger) {
            $testOrganizationTriggers->insert([
                OrganizationTrigger::FIELD_ID          => $realOrganizationTrigger->id,
                OrganizationTrigger::FIELD_NAME        => $realOrganizationTrigger->name,
                OrganizationTrigger::FIELD_DESCRIPTION => $realOrganizationTrigger->description,
                OrganizationTrigger::FIELD_CREATED_AT  => $realOrganizationTrigger->created_at,
                OrganizationTrigger::FIELD_UPDATED_AT  => $realOrganizationTrigger->updated_at,
            ]);

            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
