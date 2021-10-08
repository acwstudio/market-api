<?php

namespace App\Console\Commands;

use App\Models\Product;
use Elasticsearch\Client;
use Illuminate\Console\Command;

class ReindexProductsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:product-reindex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Indexes all products to Elasticsearch';

    /** @var \Elasticsearch\Client */
    private $elasticsearch;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Client $elasticsearch)
    {
        parent::__construct();

        $this->elasticsearch = $elasticsearch;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $productCount = Product::count();

        $this->info('Indexing all products. This might take a while...');

        $bar = $this->output->createProgressBar($productCount);

        foreach (Product::cursor() as $product)
        {
            $this->elasticsearch->index([
                'index' => $product->getSearchIndex(),
                'type' => $product->getSearchType(),
                'id' => $product->getKey(),
                'body' => $product->toSearchArray(),
            ]);

            $bar->advance();
        }
        $bar->finish();

        $this->newLine();
        $this->info('All products indexed!');
    }
}
