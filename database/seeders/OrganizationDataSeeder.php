<?php

namespace Database\Seeders;

use App\Models\Organization;
use Database\Seeders\Traits\ChunkValueSeeder;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class OrganizationDataSeeder extends Seeder
{
    use ChunkValueSeeder;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realOrganizations = \DB::connection('mysql_t')->table('organizations');
        $testOrganizations = \DB::connection('mysql')->table('organizations');

        $chunk = $this->chunkValue($realOrganizations->count());

        Schema::disableForeignKeyConstraints();

        $testOrganizations->truncate();

        $this->command->info('Seeding of Organizations is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realOrganizations->count());

        $this->command->newLine();
        $progressBar->start();

        $realOrganizations->orderBy('id')
            ->chunk($chunk, function ($organizations) use ($testOrganizations, $progressBar) {
                foreach ($organizations as $organization) {
                    $testOrganization[] = [
                        Organization::FIELD_ID                 => $organization->id,
                        Organization::FIELD_PUBLISHED          => $organization->published,
                        Organization::FIELD_NAME               => $organization->name,
                        Organization::FIELD_ABBREVIATION_NAME  => $organization->abbreviation_name,
                        Organization::FIELD_SLUG               => $organization->slug,
                        Organization::FIELD_SORT               => $organization->sort,
                        Organization::FIELD_LAND               => $organization->land,
                        Organization::FIELD_SUBTITLE           => $organization->subtitle,
                        Organization::FIELD_DESCRIPTION        => $organization->description,
                        Organization::FIELD_SITE               => $organization->site,
                        Organization::FIELD_EMAIL              => $organization->email,
                        Organization::FIELD_PHONE              => $organization->phone,
                        Organization::FIELD_HTML_BODY          => $organization->html_body,
                        Organization::FIELD_CLASSES            => $organization->classes,
                        Organization::FIELD_LOGO_CODE          => $organization->logo_code,
                        Organization::FIELD_COLOR_CODE_TITLES  => $organization->color_code_titles,
                        Organization::FIELD_PREVIEW_IMAGE      => $organization->preview_image,
                        Organization::FIELD_DIGITAL_IMAGE      => $organization->digital_image,
                        Organization::FIELD_ADDRESS            => $organization->address,
                        Organization::FIELD_IS_STATE           => $organization->is_state,
                        Organization::FIELD_IS_MILITARY_CENTER => $organization->is_military_center,
                        Organization::FIELD_IS_HOSTEL          => $organization->is_hostel,
                        Organization::FIELD_COST_YEAR_STUDY    => $organization->cost_year_study,
                        Organization::FIELD_BUDGET_PLACES      => $organization->budget_places,
                        Organization::FIELD_BUDGET_YEAR        => $organization->budget_year,
                        Organization::FIELD_BUDGET_POINTS      => $organization->budget_points,
                        Organization::FIELD_CONTRACT_PLACES    => $organization->contract_places,
                        Organization::FIELD_CONTRACT_YEAR      => $organization->contract_year,
                        Organization::FIELD_TYPE_TEXT          => $organization->type_text,
                        Organization::FIELD_MAP_LINK           => $organization->map_link,
                        Organization::FIELD_PARENT_ID          => $organization->parent_id,
                        Organization::FIELD_CITY_ID            => $organization->city_id,
                        Organization::FIELD_CREATED_AT         => $organization->created_at,
                        Organization::FIELD_UPDATED_AT         => $organization->updated_at,
                        Organization::FIELD_DELETED_AT         => $organization->deleted_at,
                    ];
                }
                $testOrganizations->insert($testOrganization);
                $progressBar->advance($organizations->count());
            });

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
