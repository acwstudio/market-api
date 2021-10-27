<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class SubjectDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realSubjects = \DB::connection('mysql_t')->table('subjects')->get();
        $testSubjects = \DB::connection('mysql')->table('subjects');

        Schema::disableForeignKeyConstraints();

        $testSubjects->truncate();

        $this->command->info('Seeding of Subjects is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realSubjects->count());

        $this->command->newLine();
        $progressBar->start();

        /** @var Subject $realSubject */
        foreach ($realSubjects as $realSubject) {
            $testSubjects->insert([
                Subject::FIELD_ID         => $realSubject->id,
                Subject::FIELD_PUBLISHED  => $realSubject->published,
                Subject::FIELD_NAME       => $realSubject->name,
                Subject::FIELD_SLUG       => $realSubject->slug,
                Subject::FIELD_DELETED_AT => $realSubject->deleted_at,
                Subject::FIELD_CREATED_AT => $realSubject->created_at,
                Subject::FIELD_UPDATED_AT => $realSubject->updated_at,
            ]);

            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
