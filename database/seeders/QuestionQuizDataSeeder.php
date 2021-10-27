<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class QuestionQuizDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realQuestionQuizzes = \DB::connection('mysql_t')->table('question_quiz')->get();
        $testQuestionQuizzes = \DB::connection('mysql')->table('question_quiz');

        Schema::disableForeignKeyConstraints();

        $testQuestionQuizzes->truncate();

        $this->command->info('Seeding of QuestionQuizzes is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realQuestionQuizzes->count());

        $this->command->newLine();
        $progressBar->start();

        foreach ($realQuestionQuizzes as $realQuestionQuiz) {
            $testQuestionQuizzes->insert([
                'question_id' => $realQuestionQuiz->question_id,
                'quiz_id' => $realQuestionQuiz->quiz_id,
            ]);

            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
