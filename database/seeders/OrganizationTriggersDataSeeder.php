<?php

namespace Database\Seeders;

use App\Models\OrganizationTrigger;
use Database\Seeders\Traits\ChunkValueSeeder;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class OrganizationTriggersDataSeeder extends Seeder
{
    use ChunkValueSeeder;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realOrganizationTriggers = \DB::connection('mysql_t')->table('organization_triggers');
        $testOrganizationTriggers = \DB::connection('mysql')->table('organization_triggers');

        $chunk = $this->chunkValue($realOrganizationTriggers->count());

        Schema::disableForeignKeyConstraints();

        $testOrganizationTriggers->truncate();

        $this->command->info('Seeding of OrganizationTriggers is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realOrganizationTriggers->count());

        $this->command->newLine();
        $progressBar->start();

        $realOrganizationTriggers->orderBy('id')
            ->chunk($chunk, function ($organizationTriggers) use ($testOrganizationTriggers, $progressBar) {
               foreach ($organizationTriggers as $organizationTrigger) {
                   $testOrganizationTrigger[] = [
                       OrganizationTrigger::FIELD_ID          => $organizationTrigger->id,
                       OrganizationTrigger::FIELD_NAME        => $organizationTrigger->name,
                       OrganizationTrigger::FIELD_DESCRIPTION => $organizationTrigger->description,
                       OrganizationTrigger::FIELD_CREATED_AT  => $organizationTrigger->created_at,
                       OrganizationTrigger::FIELD_UPDATED_AT  => $organizationTrigger->updated_at,
                   ];
               }
                $testOrganizationTriggers->insert($testOrganizationTrigger);
                $progressBar->advance($organizationTriggers->count());
            });

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
