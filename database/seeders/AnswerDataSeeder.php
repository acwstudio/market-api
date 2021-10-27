<?php

namespace Database\Seeders;

use App\Models\Answer;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class AnswerDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realAnswers = \DB::connection('mysql_t')->table('answers')->get();
        $testAnswers = \DB::connection('mysql')->table('answers');

        Schema::disableForeignKeyConstraints();

        $testAnswers->truncate();

        $this->command->info('Seeding of Answers is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realAnswers->count());

        $this->command->newLine();
        $progressBar->start();

        /** @var Answer $realAnswer */
        foreach ($realAnswers as $realAnswer) {
            $testAnswers->insert([
                Answer::FIELD_ID               => $realAnswer->id,
                Answer::FIELD_QUESTION_ID      => $realAnswer->question_id,
                Answer::FIELD_NEXT_QUESTION_ID => $realAnswer->next_question_id,
                Answer::FIELD_ANSWER           => $realAnswer->answer,
                Answer::FIELD_DELETED_AT       => $realAnswer->deleted_at,
                Answer::FIELD_CREATED_AT       => $realAnswer->created_at,
                Answer::FIELD_UPDATED_AT       => $realAnswer->updated_at,
            ]);
            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
