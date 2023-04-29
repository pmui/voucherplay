<?php

namespace App\Http\Controllers;

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

                Game::firstOrCreate($data);
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
            $games = Game::select(['id','code'])->active()->get();

            foreach ($games as $game) {
                $result = BoostConnect::getProductList($game->code);

                $products = json_decode($result);

                foreach ($products->products as $product) {
                    $data = [
                        'product_code' => $product->productCode,
                        'name' => $product->productName,
                        'value' => $product->productValue,
                        'cost' => $product->amount,
                        'price' => $product->productValue,
                    ];

                    $game->products()->updateOrCreate(['product_code' => $data['product_code']], $data);
                }
            }
            activity()->log('product synced');
            return "OK";
        }
        catch (\Exception $exception)
        {
            activity()->log('product sync failed');
            return $exception->getMessage();
        }

    }
}
