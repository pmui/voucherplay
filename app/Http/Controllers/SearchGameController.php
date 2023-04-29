<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;


class SearchGameController extends Controller
{
    public function ajax(Request $request)
    {
        $keyword = $request['q'];
        $games = Game::select(['id','code','title','image_url'])->search($keyword)->limit(5)->get();

        return response()->json($games);
    }
}
