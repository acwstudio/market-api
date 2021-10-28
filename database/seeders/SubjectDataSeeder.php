<?php

namespace Database\Seeders;

use App\Models\Subject;
use Database\Seeders\Traits\ChunkValueSeeder;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class SubjectDataSeeder extends Seeder
{
    use ChunkValueSeeder;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realSubjects = \DB::connection('mysql_t')->table('subjects');
        $testSubjects = \DB::connection('mysql')->table('subjects');

        $chunk = $this->chunkValue($realSubjects->count());

        Schema::disableForeignKeyConstraints();

        $testSubjects->truncate();

        $this->command->info('Seeding of Subjects is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realSubjects->count());

        $this->command->newLine();
        $progressBar->start();

        $testSubjects->orderBy('id')
            ->chunk($chunk, function ($subjects) use ($testSubjects, $progressBar) {
                foreach ($subjects as $subject) {
                    $testSubject[] = [
                        Subject::FIELD_ID         => $subject->id,
                        Subject::FIELD_PUBLISHED  => $subject->published,
                        Subject::FIELD_NAME       => $subject->name,
                        Subject::FIELD_SLUG       => $subject->slug,
                        Subject::FIELD_DELETED_AT => $subject->deleted_at,
                        Subject::FIELD_CREATED_AT => $subject->created_at,
                        Subject::FIELD_UPDATED_AT => $subject->updated_at,
                    ];
                }
                $testSubjects->insert($testSubject);
                $progressBar->advance();
            });
        
        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
