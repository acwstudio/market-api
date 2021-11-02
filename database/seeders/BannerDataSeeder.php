<?php

namespace Database\Seeders;

use App\Models\Banner;
use Database\Seeders\Traits\ChunkValueSeeder;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class BannerDataSeeder extends Seeder
{
    use ChunkValueSeeder;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realBanners = \DB::connection('mysql_t')->table('banners');
        $testBanners = \DB::connection('mysql')->table('banners');

        $chunk = $this->chunkValue($realBanners->count());

        Schema::disableForeignKeyConstraints();

        $testBanners->truncate();

        $this->command->info('Seeding of Banners is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realBanners->count());

        $this->command->newLine();
        $progressBar->start();

        $realBanners->orderBy('id')
            ->chunk($chunk, function ($banners) use ($testBanners, $progressBar) {
                foreach ($banners as $banner) {
                    $testBanner[] = [
                        Banner::FIELD_ID              => $banner->id,
                        Banner::FIELD_PUBLISHED       => $banner->published,
                        Banner::FIELD_NAME            => $banner->name,
                        Banner::FIELD_NAME_SECOND     => $banner->name_second,
                        Banner::FIELD_LINK            => $banner->link,
                        Banner::FIELD_BANNER_TYPE     => $banner->banner_type,
                        Banner::FIELD_DESCRIPTION     => $banner->description,
                        Banner::FIELD_COLOR_BG        => $banner->color_bg,
                        Banner::FIELD_COLOR_TEXT      => $banner->color_text,
                        Banner::FIELD_COLOR_BG_LIST   => $banner->color_bg_list,
                        Banner::FIELD_COLOR_TEXT_LIST => $banner->color_text_list,
                        Banner::FIELD_IMAGE           => $banner->image,
                        Banner::FIELD_CREATED_AT      => $banner->created_at,
                        Banner::FIELD_UPDATED_AT      => $banner->updated_at,
                    ];
                }
                $testBanners->insert($testBanner);
                $progressBar->advance($banners->count());
            });

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
