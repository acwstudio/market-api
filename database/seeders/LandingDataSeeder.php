<?php

namespace Database\Seeders;

use App\Models\Landing;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class LandingDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realLandings = \DB::connection('mysql_t')->table('landings')->get();
        $testLandings = \DB::connection('mysql')->table('landings');

        Schema::disableForeignKeyConstraints();

        $testLandings->truncate();

        $this->command->info('Seeding of Landings is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realLandings->count());

        $this->command->newLine();
        $progressBar->start();

        /** @var Landing $realLanding */
        foreach ($realLandings as $realLanding) {
            $testLandings->insert([
                Landing::FIELD_ID                   => $realLanding->id,
                Landing::FIELD_NAME                 => $realLanding->name,
                Landing::FIELD_SLUG                 => $realLanding->slug,
                Landing::FIELD_DESCRIPTION          => $realLanding->description,
                Landing::FIELD_COLOR_BG             => $realLanding->color_bg,
                Landing::FIELD_IMAGE_SRC            => $realLanding->image_src,
                Landing::FIELD_IS_ALL_FORMS         => $realLanding->is_all_forms,
                Landing::FIELD_IS_ALL_LEVELS        => $realLanding->is_all_levels,
                Landing::FIELD_IS_ALL_DIRECTIONS    => $realLanding->is_all_directions,
                Landing::FIELD_IS_ALL_CITIES        => $realLanding->is_all_cities,
                Landing::FIELD_IS_ALL_ORGANIZATIONS => $realLanding->is_all_organizations,
                Landing::FIELD_CREATED_AT           => $realLanding->created_at,
                Landing::FIELD_UPDATED_AT           => $realLanding->updated_at,
                Landing::FIELD_DELETED_AT           => $realLanding->deleted_at,
            ]);

            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
