<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
         $this->call(AnswerDataSeeder::class);
         $this->call(AppDataSeeder::class);
         $this->call(BannerDataSeeder::class);
         $this->call(CategoryDataSeeder::class);
         $this->call(CityDataSeeder::class);
         $this->call(ComponentDataSeeder::class);
         $this->call(ComponentMethodDataSeeder::class);
         $this->call(ComponentPageDataSeeder::class);
         $this->call(DirectionDataSeeder::class);
         $this->call(EntitySectionDataSeeder::class);
         $this->call(FormatDataSeeder::class);
         $this->call(LandingableDataSeeder::class);
         $this->call(LandingDataSeeder::class);
         $this->call(LeadDataSeeder::class);
         $this->call(LevelDataSeeder::class);
         $this->call(MenuDataSeeder::class);
         $this->call(MethodDataSeeder::class);
         $this->call(OptionDataSeeder::class);
         $this->call(OrganizationablesDataSeeder::class);
         $this->call(OrganizationablesDataSeeder::class);
         $this->call(OrganizationDataSeeder::class);
         $this->call(OrganizationPersonDataSeeder::class);
         $this->call(OrganizationTriggersDataSeeder::class);
         $this->call(PageDataSeeder::class);
         $this->call(PersonDataSeeder::class);
         $this->call(ProductablesDataSeeder::class);
         $this->call(ProductDataSeeder::class);
         $this->call(ProductPlacesDataSeeder::class);
         $this->call(QuestionDataSeeder::class);
         $this->call(QuestionQuizDataSeeder::class);
         $this->call(QuizDataSeeder::class);
         $this->call(SectionDataSeeder::class);
         $this->call(SeoTagsDataSeeder::class);
         $this->call(SocialNetworksDataSeeder::class);
         $this->call(SubjectDataSeeder::class);
         $this->call(ThemeColorsDataSeeder::class);
         $this->call(ThemeDataSeeder::class);
    }
}
