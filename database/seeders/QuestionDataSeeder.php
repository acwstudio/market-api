<?php

namespace Database\Seeders;

use App\Models\Question;
use Database\Seeders\Traits\ChunkValueSeeder;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class QuestionDataSeeder extends Seeder
{
    use ChunkValueSeeder;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realQuestions = \DB::connection('mysql_t')->table('questions');
        $testQuestions = \DB::connection('mysql')->table('questions');

        $chunk = $this->chunkValue($realQuestions->count());

        Schema::disableForeignKeyConstraints();

        $testQuestions->truncate();

        $this->command->info('Seeding of Questions is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realQuestions->count());

        $this->command->newLine();
        $progressBar->start();

        $realQuestions->orderBy('id')
            ->chunk($chunk, function ($questions) use ($testQuestions, $progressBar) {
                foreach ($questions as $question) {
                    $testQuestion[] = [
                        Question::FIELD_ID         => $question->id,
                        Question::FIELD_QUESTION   => $question->question,
                        Question::FIELD_PUBLISHED  => $question->published,
                        Question::FIELD_DELETED_AT => $question->deleted_at,
                        Question::FIELD_CREATED_AT => $question->created_at,
                        Question::FIELD_UPDATED_AT => $question->updated_at,
                    ];
                }
                $testQuestions->insert($testQuestion);
                $progressBar->advance($questions->count());
            });

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
