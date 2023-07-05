<?php

namespace App\Http\Controllers;

use App\Models\Game;

class HomeController extends Controller
{
    public function __invoke()
    {

        $games = Game::active()->get();
        return view('home', ['games' => $games]);
    }
}
