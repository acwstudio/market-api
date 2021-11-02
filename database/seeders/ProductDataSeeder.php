<?php

namespace Database\Seeders;

use App\Models\Product;
use Database\Seeders\Traits\ChunkValueSeeder;
use Illuminate\Database\Seeder;
use Schema;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class ProductDataSeeder extends Seeder
{
    use ChunkValueSeeder;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realProducts = \DB::connection('mysql_t')->table('products');
        $testProducts = \DB::connection('mysql')->table('products');

        $chunk = $this->chunkValue($realProducts->count());

        Schema::disableForeignKeyConstraints();

        $testProducts->truncate();

        $this->command->info('Seeding of Products is starting ...');

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $realProducts->count());

        $this->command->newLine();
        $progressBar->start();

        $realProducts->orderBy('id')
            ->chunk($chunk, function ($products) use ($testProducts, $progressBar) {
                foreach ($products as $product) {
                    $testProduct[] = [
                        Product::FIELD_ID                          => $product->id,
                        Product::FIELD_IS_MODERATED                => $product->is_moderated,
                        Product::FIELD_LAND                        => $product->land,
                        Product::FIELD_PUBLISHED                   => $product->published,
                        Product::FIELD_EXPIRATION_DATE             => $product->expiration_date,
                        Product::FIELD_NAME                        => $product->name,
                        Product::FIELD_SLUG                        => $product->slug,
                        Product::FIELD_SORT                        => $product->sort,
                        Product::FIELD_PREVIEW_IMAGE               => $product->preview_image,
                        Product::FIELD_PRICE                       => $product->price,
                        Product::FIELD_START_DATE                  => $product->start_date,
                        Product::FIELD_IS_EMPLOYMENT               => $product->is_employment,
                        Product::FIELD_IS_INSTALLMENT              => $product->is_installment,
                        Product::FIELD_INSTALLMENT_MONTHS          => $product->installment_months,
                        Product::FIELD_IS_DOCUMENT                 => $product->is_document,
                        Product::FIELD_DOCUMENT                    => $product->document,
                        Product::FIELD_TRIGGERS                    => $product->triggers,
                        Product::FIELD_BEGIN_DURATION              => $product->begin_duration,
                        Product::FIELD_BEGIN_DURATION_FORMAT_VALUE => $product->begin_duration_format_value,
                        Product::FIELD_DESCRIPTION                 => $product->description,
                        Product::FIELD_COLOR                       => $product->color,
                        Product::FIELD_ORGANIZATION_ID             => $product->organization_id,
                        Product::FIELD_CATEGORY_ID                 => $product->category_id,
                        Product::FIELD_USER_ID                     => $product->user_id,
                        Product::FIELD_DELETED_AT                  => $product->deleted_at,
                        Product::FIELD_CREATED_AT                  => $product->created_at,
                        Product::FIELD_UPDATED_AT                  => $product->updated_at,
                    ];
                }
                $testProducts->insert($testProduct);
                $progressBar->advance();
            });


        Schema::enableForeignKeyConstraints();

        $progressBar->finish();
        $this->command->newLine(2);
    }
}
