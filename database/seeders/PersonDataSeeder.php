<?php

namespace Database\Seeders;

use App\Models\Person;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class PersonDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realPersons = \DB::connection('mysql_t')->table('persons')->get();
        $testPersons = \DB::connection('mysql')->table('persons');

        Schema::disableForeignKeyConstraints();

        $testPersons->truncate();

        $this->command->info('Seeding of Persons is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realPersons->count());

        $this->command->newLine();
        $progressBar->start();

        /** @var Person $realPerson */
        foreach ($realPersons as $realPerson) {
            $testPersons->insert([
                Person::FIELD_ID              => $realPerson->id,
                Person::FIELD_PUBLISHED              => $realPerson->published,
                Person::FIELD_NAME            => $realPerson->name,
                Person::FIELD_POSITION         => $realPerson->position,
                Person::FIELD_SHOW_MAIN     => $realPerson->show_main,
                Person::FIELD_DESCRIPTION   => $realPerson->description,
                Person::FIELD_PREVIEW_IMAGE => $realPerson->preview_image,
                Person::FIELD_DELETED_AT       => $realPerson->deleted_at,
                Person::FIELD_CREATED_AT      => $realPerson->created_at,
                Person::FIELD_UPDATED_AT      => $realPerson->updated_at,
            ]);

            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
