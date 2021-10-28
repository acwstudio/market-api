<?php

namespace Database\Seeders;

use App\Models\Answer;
use Database\Seeders\Traits\ChunkValueSeeder;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class AnswerDataSeeder extends Seeder
{
    use ChunkValueSeeder;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realAnswers = \DB::connection('mysql_t')->table('answers');
        $testAnswers = \DB::connection('mysql')->table('answers');

        $chunk = $this->chunkValue($realAnswers->count());

        Schema::disableForeignKeyConstraints();

        $testAnswers->truncate();

        $this->command->info('Seeding of Answers is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realAnswers->count());

        $this->command->newLine();
        $progressBar->start();

        $realAnswers->orderBy('id')
            ->chunk($chunk, function ($answers) use ($testAnswers, $progressBar) {
                foreach ($answers as $answer) {
                    $testAnswer[] = [
                        Answer::FIELD_ID               => $answer->id,
                        Answer::FIELD_QUESTION_ID      => $answer->question_id,
                        Answer::FIELD_NEXT_QUESTION_ID => $answer->next_question_id,
                        Answer::FIELD_ANSWER           => $answer->answer,
                        Answer::FIELD_DELETED_AT       => $answer->deleted_at,
                        Answer::FIELD_CREATED_AT       => $answer->created_at,
                        Answer::FIELD_UPDATED_AT       => $answer->updated_at,
                    ];
                }

                $testAnswers->insert($testAnswer);
                $progressBar->advance($answers->count());
            });

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
