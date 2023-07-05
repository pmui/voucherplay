<?php

namespace App\Http\Controllers;

use App\Models\Game;

class TopUpController extends Controller
{
    public function __invoke(Game $game)
    {

        if (!$game->active) return redirect(route('home'));
        return view('top-up',['game' => $game, 'cache'=>\Cache::get('*')] );
    }
}
