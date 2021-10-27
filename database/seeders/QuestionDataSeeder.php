<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class QuestionDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realQuestions = \DB::connection('mysql_t')->table('questions')->get();
        $testQuestions = \DB::connection('mysql')->table('questions');

        Schema::disableForeignKeyConstraints();

        $testQuestions->truncate();

        $this->command->info('Seeding of Questions is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realQuestions->count());

        $this->command->newLine();
        $progressBar->start();

        /** @var Question $realQuestion */
        foreach ($realQuestions as $realQuestion) {
            $testQuestions->insert([
                Question::FIELD_ID              => $realQuestion->id,
                Question::FIELD_QUESTION            => $realQuestion->question,
                Question::FIELD_PUBLISHED         => $realQuestion->published,
                Question::FIELD_DELETED_AT       => $realQuestion->deleted_at,
                Question::FIELD_CREATED_AT      => $realQuestion->created_at,
                Question::FIELD_UPDATED_AT      => $realQuestion->updated_at,
            ]);

            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
