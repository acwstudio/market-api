<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class ProductDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realProducts = \DB::connection('mysql_t')->table('products')->get();
        $testProducts = \DB::connection('mysql')->table('products');

        Schema::disableForeignKeyConstraints();

        $testProducts->truncate();

        $this->command->info('Seeding of Products is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realProducts->count());

        $this->command->newLine();
        $progressBar->start();

        /** @var Product $realProduct */
        foreach ($realProducts as $realProduct) {
            $testProducts->insert([
                Product::FIELD_ID                          => $realProduct->id,
                Product::FIELD_IS_MODERATED                => $realProduct->is_moderated,
                Product::FIELD_LAND                        => $realProduct->land,
                Product::FIELD_PUBLISHED                   => $realProduct->published,
                Product::FIELD_EXPIRATION_DATE             => $realProduct->expiration_date,
                Product::FIELD_NAME                        => $realProduct->name,
                Product::FIELD_SLUG                        => $realProduct->slug,
                Product::FIELD_SORT                        => $realProduct->sort,
                Product::FIELD_PREVIEW_IMAGE               => $realProduct->preview_image,
                Product::FIELD_PRICE                       => $realProduct->price,
                Product::FIELD_START_DATE                  => $realProduct->start_date,
                Product::FIELD_IS_EMPLOYMENT               => $realProduct->is_employment,
                Product::FIELD_IS_INSTALLMENT              => $realProduct->is_installment,
                Product::FIELD_INSTALLMENT_MONTHS          => $realProduct->installment_months,
                Product::FIELD_IS_DOCUMENT                 => $realProduct->is_document,
                Product::FIELD_DOCUMENT                    => $realProduct->document,
                Product::FIELD_TRIGGERS                    => $realProduct->triggers,
                Product::FIELD_BEGIN_DURATION              => $realProduct->begin_duration,
                Product::FIELD_BEGIN_DURATION_FORMAT_VALUE => $realProduct->begin_duration_format_value,
                Product::FIELD_DESCRIPTION                 => $realProduct->description,
                Product::FIELD_COLOR                       => $realProduct->color,
                Product::FIELD_ORGANIZATION_ID             => $realProduct->organization_id,
                Product::FIELD_CATEGORY_ID                 => $realProduct->category_id,
                Product::FIELD_USER_ID                     => $realProduct->user_id,
                Product::FIELD_DELETED_AT                  => $realProduct->deleted_at,
                Product::FIELD_CREATED_AT                  => $realProduct->created_at,
                Product::FIELD_UPDATED_AT                  => $realProduct->updated_at,
            ]);

            $progressBar->advance();
        }

        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
