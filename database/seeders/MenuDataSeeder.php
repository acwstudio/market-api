<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class MenuDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realMenus = \DB::connection('mysql_t')->table('menus')->get();
        $testMenus = \DB::connection('mysql')->table('menus');

        Schema::disableForeignKeyConstraints();

        $testMenus->truncate();

        $this->command->info('Seeding of Menus is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realMenus->count());

        $this->command->newLine();
        $progressBar->start();

        /** @var Menu $realMenu */
        foreach ($realMenus as $realMenu) {
            $testMenus->insert([
                Menu::FIELD_ID         => $realMenu->id,
                Menu::FIELD_ACTIVE     => $realMenu->active,
                Menu::FIELD_MODEL      => $realMenu->model,
                Menu::FIELD_MODEL_ID   => $realMenu->model_id,
                Menu::FIELD_ANCHOR     => $realMenu->anchor,
                Menu::FIELD_POINTER    => $realMenu->pointer,
                Menu::FIELD_DELETED_AT => $realMenu->deleted_at,
                Menu::FIELD_CREATED_AT => $realMenu->created_at,
                Menu::FIELD_UPDATED_AT => $realMenu->updated_at,
            ]);

            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
