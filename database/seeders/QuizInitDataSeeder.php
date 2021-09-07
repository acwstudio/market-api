<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizInitDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quizzes = DB::table('quizzes');
        $questions = DB::table('questions');
        $answers = DB::table('answers');
        $leads = DB::table('leads');
        $pivotQuestionQuiz = DB::table('question_quiz');

        if ($quizzes->count()) {
            $quizzes->truncate();
            $questions->truncate();
            $answers->truncate();
            $leads->truncate();
            $pivotQuestionQuiz->truncate();
        }

        $leadsData = config('initial_data.quiz.leads');

        foreach ($leadsData as $lead) {
            $lead_id = $leads->insertGetId([
//                'quiz_id' => $quiz_id,
                'name' => $lead['name'],
                'description' => $lead['description'],
                'title' => $lead['title'],
                'text' => $lead['text'],
                'created_at' => now()
            ]);
        }

        $quizzesData = config('initial_data.quiz.quizzes');

        foreach ($quizzesData as $quiz) {
            $quiz_id = $quizzes->insertGetId([
                'lead_id' => $leads->first()->id,
                'name' => $quiz['name'],
                'description' => $quiz['description'],
                'page' => $quiz['page'],
                'title' => $quiz['title'],
                'text' => $quiz['text'],
                'button' => $quiz['button'],
                'published' => true,
                'created_at' => now()
            ]);
        }

        $questionsData = config('initial_data.quiz.questions');

        foreach ($questionsData as $question) {
            $question_id = $questions->insertGetId([
                'question' => $question[0],
                'published' => true,
                'created_at' => now()
            ]);

            $answersData = $question[1];

            foreach ($answersData as $answer) {
                $answers->insert([
                    'question_id' => $question_id,
                    'answer' => $answer,
                    'next_question_id' => 1,
                    'created_at' => now()
                ]);
            }
        }

        foreach ($quizzes->get() as $quiz) {
            foreach ($questions->get() as $question) {
                $pivotQuestionQuiz->insert([
                    'quiz_id' => $quiz->id,
                    'question_id' => $question->id,
                ]);
            }
        }
    }
}
