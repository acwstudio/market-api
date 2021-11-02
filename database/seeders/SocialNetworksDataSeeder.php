<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class SocialNetworksDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realSocialNetworks = \DB::connection('mysql_t')->table('social_networks')->get();
        $testSocialNetworks = \DB::connection('mysql')->table('social_networks');

        Schema::disableForeignKeyConstraints();

        $testSocialNetworks->truncate();

        $this->command->info('Seeding of SocialNetworks is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realSocialNetworks->count());

        $this->command->newLine();
        $progressBar->start();

        /** @var SocialNetwork $realSocialNetwork */
        foreach ($realSocialNetworks as $realSocialNetwork) {
            $testSocialNetworks->insert([
//                SocialNetwork::FIELD_ID              => $realSocialNetwork->id,
//                SocialNetwork::FIELD_NAME            => $realSocialNetwork->name,
//                SocialNetwork::FIELD_COUNTRY         => $realSocialNetwork->country,
//                SocialNetwork::FIELD_REGION_NAME     => $realSocialNetwork->region_name,
//                SocialNetwork::FIELD_SocialNetwork_KLADR_ID   => $realSocialNetwork->SocialNetwork_kladr_id,
//                SocialNetwork::FIELD_REGION_KLADR_ID => $realSocialNetwork->region_kladr_id,
//                SocialNetwork::FIELD_GEONAME_ID      => $realSocialNetwork->geoname_id,
//                SocialNetwork::FIELD_GEO_POINT       => $realSocialNetwork->geo_point,
//                SocialNetwork::FIELD_CREATED_AT      => $realSocialNetwork->created_at,
//                SocialNetwork::FIELD_UPDATED_AT      => $realSocialNetwork->updated_at,
            ]);

//            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

//        $progressBar->finish();
        $this->command->newLine(2);
    }
}
