<?php

namespace Database\Seeders;

use App\Models\Lead;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class LeadDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realLeads = \DB::connection('mysql_t')->table('leads')->get();
        $testLeads = \DB::connection('mysql')->table('leads');

        Schema::disableForeignKeyConstraints();

        $testLeads->truncate();

        $this->command->info('Seeding of Leads is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realLeads->count());

        $this->command->newLine();
        $progressBar->start();

        /** @var Lead $realLead */
        foreach ($realLeads as $realLead) {
            $testLeads->insert([
                Lead::FIELD_ID          => $realLead->id,
                Lead::FIELD_NAME        => $realLead->name,
                Lead::FIELD_DESCRIPTION => $realLead->description,
                Lead::FIELD_TITLE       => $realLead->title,
                Lead::FIELD_TEXT        => $realLead->text,
                Lead::FIELD_DELETED_AT  => $realLead->deleted_at,
                Lead::FIELD_CREATED_AT  => $realLead->created_at,
                Lead::FIELD_UPDATED_AT  => $realLead->updated_at,
            ]);

            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
