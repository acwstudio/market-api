<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DataFillingProductablesTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data-filling:productables';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Data filing productables table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $directionProducts = DB::table('direction_product')->get();
        $levelProducts     = DB::table('level_product')->get();
        $subjectProducts   = DB::table('product_subject')->get();
        $personProducts    = DB::table('person_product')->get();
        $formatProducts    = DB::table('format_product')->get();

        $productables = DB::table('productables');

        if ($productables->count()){
            $productables->truncate();
        }

        //*****************  DIRECTIONS PRODUCTS  ******************
        $this->info('Start insert directions with products...');

        $bar = $this->output->createProgressBar($directionProducts->count());

        $this->line('Filling directions products');

        foreach ($directionProducts as $directionProduct) {

            $productables->insert([
                'product_id'     => $directionProduct->product_id,
                'productable_id' => $directionProduct->direction_id,
                'productable_type'   => 'App\Models\Direction',
            ]);
            $bar->advance();

        }
        $bar->finish();

        $this->newLine();
        $this->info('All directions products processed!');

        //*****************  LEVELS PRODUCTS  ******************
        $this->info('Start insert levels with products...');

        $bar = $this->output->createProgressBar($levelProducts->count());

        $this->line('Filling levels products');

        foreach ($levelProducts as $levelProduct) {

            $productables->insert([
                'product_id'     => $levelProduct->product_id,
                'productable_id' => $levelProduct->level_id,
                'productable_type'   => 'App\Models\Level',
            ]);
            $bar->advance();

        }
        $bar->finish();

        $this->newLine();
        $this->info('All levels products processed!');

        //*****************  PRODUCTS SUBJECTS  ******************
        $this->info('Start insert subjects with products...');

        $bar = $this->output->createProgressBar($subjectProducts->count());

        $this->line('Filling subjects products');

        foreach ($subjectProducts as $subjectProduct) {

            $productables->insert([
                'product_id'     => $subjectProduct->product_id,
                'productable_id' => $subjectProduct->subject_id,
                'productable_type'   => 'App\Models\Subject',
            ]);
            $bar->advance();

        }
        $bar->finish();

        $this->newLine();
        $this->info('All subjects products processed!');

        //*****************  PERSONS PRODUCTS  ******************
//        $this->info('Start insert persons with products...');
//
//        $bar = $this->output->createProgressBar($personProducts->count());
//
//        $this->line('Filling persons products');
//
//        foreach ($personProducts as $personProduct) {
//
//            $productables->insert([
//                'product_id'     => $personProduct->product_id,
//                'productable_id' => $personProduct->person_id,
//                'productable_type'   => 'App\Models\Person',
//            ]);
//            $bar->advance();
//
//        }
//        $bar->finish();
//
//        $this->newLine();
//        $this->info('All persons products processed!');

        //*****************  FORMATS PRODUCTS  ******************
        $this->info('Start insert formats with products...');

        $bar = $this->output->createProgressBar($personProducts->count());

        $this->line('Filling formats products');

        foreach ($formatProducts as $formatProduct) {

            $productables->insert([
                'product_id'     => $formatProduct->product_id,
                'productable_id' => $formatProduct->format_id,
                'productable_type'   => 'App\Models\Format',
            ]);
            $bar->advance();

        }
        $bar->finish();

        $this->newLine();
        $this->info('All formats products processed!');

        return 1;
    }
}
