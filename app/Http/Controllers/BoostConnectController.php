<?php

namespace App\Http\Controllers;

use App\Jobs\AutoPriceJob;
use App\Models\Game;
use App\Services\BoostConnect;
use Illuminate\Http\Request;

class BoostConnectController extends Controller
{
    public function validateAccount(Request $request)
    {
        return BoostConnect::validateAccount($request['product_code'], $request['account']);
    }

    public function syncGames()
    {
        try {
            $games = BoostConnect::getCategoryList();

            $games = json_decode($games);

            foreach ($games->productCategories as $game) {
                $data = [
                    'code' => $game->categoryCode,
                    'title' => $game->categoryName,
                ];

                $existingGame = Game::where('code', $game->categoryCode)->first();
                if ($existingGame) {
                    continue; // Skip creating a new record
                }

                Game::create($data);
            }
            activity()->log('game sync success');
            return "OK";
        }

        catch (\Exception $exception)
        {
            activity()->log('game sync failed');
            return $exception->getMessage();
        }
    }

    public function syncGameType()
    {
        try {
            $games = Game::select(['id','code','type'])->whereNull('type')->active()->get();
            if ($games)
            {
                foreach ($games as $game) {
                    $result = BoostConnect::getProductList($game->code);

                    $products = json_decode($result);

                    if (!$products->products)
                        continue;

                    $type = '';
                    $sample_product = $products->products[0];

                    if ($sample_product->productType == 'topup') {
                        $type = 'top-up';
                    } elseif ($sample_product->productType == 'standard') {
                        $type = 'voucher';
                    }

                    $game->update([
                        'type' => $type,
                        'validation_fields' => $sample_product->userValidationFields ?? null
                    ]);
                }

                activity()->log('new game type synced');
            }
            return "OK";
        }
        catch (\Exception $exception)
        {
            activity()->log('game type sync failed');
            return $exception->getMessage();
        }

    }

    public function syncProducts()
    {

        try {
            $start = hrtime(true);

            $games = Game::select(['id','code'])->active()->get();

            foreach ($games as $game) {
                $result = BoostConnect::getProductList($game->code);
                $products = json_decode($result);

                $productData = [];
                foreach ($products->products ?? [] as $product) {
                    $data = [
                        'game_id' => $game->id,
                        'product_code' => $product->productCode,
                        'name' => $product->productName,
                        'value' => $product->productValue,
                        'cost' => $product->amount,
                        'price' => $product->productValue,
                    ];

                    $productData[] = $data;
                }
                $game->products()->upsert($productData, ['product_code'], ['name', 'value', 'cost', 'price']);
            }


            activity()->log('product synced');
            $this->dispatch(new AutoPriceJob());

            $end = hrtime(true); // End time

            $executionTime = ($end - $start) / 1e+6; // Calculate execution time in milliseconds

            return $executionTime. "ms";
        }
        catch (\Exception $exception)
        {
            activity()->log('product sync failed');
            return $exception->getMessage();
        }

    }
}
