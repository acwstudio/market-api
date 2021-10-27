<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class OrganizationDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realOrganizations = \DB::connection('mysql_t')->table('organizations')->get();
        $testOrganizations = \DB::connection('mysql')->table('organizations');

        Schema::disableForeignKeyConstraints();

        $testOrganizations->truncate();

        $this->command->info('Seeding of Organizations is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realOrganizations->count());

        $this->command->newLine();
        $progressBar->start();

        /** @var Organization $realOrganization */
        foreach ($realOrganizations as $realOrganization) {
            $testOrganizations->insert([
                Organization::FIELD_ID                 => $realOrganization->id,
                Organization::FIELD_PUBLISHED          => $realOrganization->published,
                Organization::FIELD_NAME               => $realOrganization->name,
                Organization::FIELD_ABBREVIATION_NAME  => $realOrganization->abbreviation_name,
                Organization::FIELD_SLUG               => $realOrganization->slug,
                Organization::FIELD_SORT               => $realOrganization->sort,
                Organization::FIELD_LAND               => $realOrganization->land,
                Organization::FIELD_SUBTITLE           => $realOrganization->subtitle,
                Organization::FIELD_DESCRIPTION        => $realOrganization->description,
                Organization::FIELD_SITE               => $realOrganization->site,
                Organization::FIELD_EMAIL              => $realOrganization->email,
                Organization::FIELD_PHONE              => $realOrganization->phone,
                Organization::FIELD_HTML_BODY          => $realOrganization->html_body,
                Organization::FIELD_CLASSES            => $realOrganization->classes,
                Organization::FIELD_LOGO_CODE          => $realOrganization->logo_code,
                Organization::FIELD_COLOR_CODE_TITLES  => $realOrganization->color_code_titles,
                Organization::FIELD_PREVIEW_IMAGE      => $realOrganization->preview_image,
                Organization::FIELD_DIGITAL_IMAGE      => $realOrganization->digital_image,
                Organization::FIELD_ADDRESS            => $realOrganization->address,
                Organization::FIELD_IS_STATE           => $realOrganization->is_state,
                Organization::FIELD_IS_MILITARY_CENTER => $realOrganization->is_military_center,
                Organization::FIELD_IS_HOSTEL          => $realOrganization->is_hostel,
                Organization::FIELD_COST_YEAR_STUDY    => $realOrganization->cost_year_study,
                Organization::FIELD_BUDGET_PLACES      => $realOrganization->budget_places,
                Organization::FIELD_BUDGET_YEAR        => $realOrganization->budget_year,
                Organization::FIELD_BUDGET_POINTS      => $realOrganization->budget_points,
                Organization::FIELD_CONTRACT_PLACES    => $realOrganization->contract_places,
                Organization::FIELD_CONTRACT_YEAR      => $realOrganization->contract_year,
                Organization::FIELD_TYPE_TEXT          => $realOrganization->type_text,
                Organization::FIELD_MAP_LINK           => $realOrganization->map_link,
                Organization::FIELD_PARENT_ID          => $realOrganization->parent_id,
                Organization::FIELD_CITY_ID            => $realOrganization->city_id,
                Organization::FIELD_CREATED_AT         => $realOrganization->created_at,
                Organization::FIELD_UPDATED_AT         => $realOrganization->updated_at,
                Organization::FIELD_DELETED_AT         => $realOrganization->deleted_at,
            ]);

            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
