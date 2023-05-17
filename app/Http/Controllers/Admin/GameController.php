<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Product;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::withCount('products')->get();
        return view('admin.games.index', compact('games'));
    }

    public function show(Game $game)
    {
        return view('admin.games.show', compact('game'));
    }

}
