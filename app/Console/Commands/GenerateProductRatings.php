<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class GenerateProductRatings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:generate-ratings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate realistic ratings for all products';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $products = Product::all();
        $count = 0;

        $this->withProgressBar($products, function ($product) use (&$count) {
            if ($product->overall_rating == 0) {
                $product->generateRealisticRating();
                $count++;
            }
        });

        $this->newLine();
        $this->info("Generated ratings for {$count} products!");
    }
}
