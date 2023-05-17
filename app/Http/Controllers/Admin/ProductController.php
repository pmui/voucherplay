<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Game;
use App\Models\Product;
use Illuminate\Support\Facades\Request;

class ProductController extends Controller
{
    public function create(CreateProductRequest $request)
    {
        $product = new Product();
        $product->game_id = $request->game_id;
        $product->product_code = $request->product_code;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->cost = $request->cost;
        $product->value = $request->value;
        $product->active = $request->has('active') ? $request->active : true;
        $product->save();

        return response()->json(['product' => $product]);
    }

    public function edit(Game $game, Product $product)
    {
        return view('admin.games.product.edit', compact('game', 'product'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return $product;
    }
}
