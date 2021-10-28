<?php

namespace Database\Seeders;

use App\Models\Person;
use Database\Seeders\Traits\ChunkValueSeeder;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class PersonDataSeeder extends Seeder
{
    use ChunkValueSeeder;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realPersons = \DB::connection('mysql_t')->table('persons');
        $testPersons = \DB::connection('mysql')->table('persons');

        $chunk = $this->chunkValue($realPersons->count());

        Schema::disableForeignKeyConstraints();

        $testPersons->truncate();

        $this->command->info('Seeding of Persons is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realPersons->count());

        $this->command->newLine();
        $progressBar->start();

        $realPersons->orderBy('id')
            ->chunk($chunk, function ($persons) use ($testPersons, $progressBar) {
                foreach ($persons as $person) {
                    $testPerson[] = [
                        Person::FIELD_ID            => $person->id,
                        Person::FIELD_PUBLISHED     => $person->published,
                        Person::FIELD_NAME          => $person->name,
                        Person::FIELD_POSITION      => $person->position,
                        Person::FIELD_SHOW_MAIN     => $person->show_main,
                        Person::FIELD_DESCRIPTION   => $person->description,
                        Person::FIELD_PREVIEW_IMAGE => $person->preview_image,
                        Person::FIELD_DELETED_AT    => $person->deleted_at,
                        Person::FIELD_CREATED_AT    => $person->created_at,
                        Person::FIELD_UPDATED_AT    => $person->updated_at,
                    ];
                }
                $testPersons->insert($testPerson);
                $progressBar->advance($persons->count());
            });

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
