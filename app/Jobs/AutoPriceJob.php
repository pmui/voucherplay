<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AutoPriceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        /*$products = Product::active()->get();

        foreach ($products as $product) {

        }*/

        \DB::statement('UPDATE products set price = cost * 1.01 WHERE active = 1');
        \DB::statement("UPDATE games
            SET discount_info = (
                SELECT MAX(products.value - products.price)
                FROM products
                WHERE products.game_id = games.id
            ) WHERE active = 1");
        activity()->log('auto update price');
    }
}
