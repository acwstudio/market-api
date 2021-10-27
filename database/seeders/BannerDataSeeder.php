<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class BannerDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realBanners = \DB::connection('mysql_t')->table('banners')->get();
        $testBanners = \DB::connection('mysql')->table('banners');

        Schema::disableForeignKeyConstraints();

        $testBanners->truncate();

        $this->command->info('Seeding of Banners is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realBanners->count());

        $this->command->newLine();
        $progressBar->start();

        /** @var Banner $realBanner */
        foreach ($realBanners as $realBanner) {
            $testBanners->insert([
                Banner::FIELD_ID              => $realBanner->id,
                Banner::FIELD_PUBLISHED       => $realBanner->published,
                Banner::FIELD_NAME            => $realBanner->name,
                Banner::FIELD_NAME_SECOND     => $realBanner->name_second,
                Banner::FIELD_LINK            => $realBanner->link,
                Banner::FIELD_BANNER_TYPE     => $realBanner->banner_type,
                Banner::FIELD_DESCRIPTION     => $realBanner->description,
                Banner::FIELD_COLOR_BG        => $realBanner->color_bg,
                Banner::FIELD_COLOR_TEXT      => $realBanner->color_text,
                Banner::FIELD_COLOR_BG_LIST   => $realBanner->color_bg_list,
                Banner::FIELD_COLOR_TEXT_LIST => $realBanner->color_text_list,
                Banner::FIELD_IMAGE           => $realBanner->image,
                Banner::FIELD_CREATED_AT      => $realBanner->created_at,
                Banner::FIELD_UPDATED_AT      => $realBanner->updated_at,
            ]);

            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
