<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class QuizDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realQuizzes = \DB::connection('mysql_t')->table('quizzes')->get();
        $testQuizzes = \DB::connection('mysql')->table('quizzes');

        Schema::disableForeignKeyConstraints();

        $testQuizzes->truncate();

        $this->command->info('Seeding of Quizzes is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realQuizzes->count());

        $this->command->newLine();
        $progressBar->start();

        /** @var Quiz $realQuiz */
        foreach ($realQuizzes as $realQuiz) {
            $testQuizzes->insert([
                Quiz::FIELD_ID               => $realQuiz->id,
                Quiz::FIELD_LEAD_ID          => $realQuiz->lead_id,
                Quiz::FIELD_NAME             => $realQuiz->name,
                Quiz::FIELD_DESCRIPTION      => $realQuiz->description,
                Quiz::FIELD_PAGE             => $realQuiz->page,
                Quiz::FIELD_TITLE            => $realQuiz->title,
                Quiz::FIELD_TEXT             => $realQuiz->text,
                Quiz::FIELD_BUTTON           => $realQuiz->button,
                Quiz::FIELD_PUBLISHED        => $realQuiz->published,
                Quiz::FIELD_BACKGROUND_IMAGE => $realQuiz->background_image,
                Quiz::FIELD_PERSON_IMAGE     => $realQuiz->person_image,
                Quiz::FIELD_DELETED_AT       => $realQuiz->deleted_at,
                Quiz::FIELD_CREATED_AT       => $realQuiz->created_at,
                Quiz::FIELD_UPDATED_AT       => $realQuiz->updated_at,
            ]);

            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
