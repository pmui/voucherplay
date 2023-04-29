<?php

namespace App\Http\Controllers;

use App\Models\Game;

class HomeController extends Controller
{
    public function __invoke()
    {
        /*$games = [
            ['title'=>'Mobile Legend', 'img_url'=>'https://storage.googleapis.com/prod-storefront-static-files/0e3e84d6-ed14-4aff-a760-6debd07bc14e.png', 'url'=>'#'],
            ['title'=>'Genshin Impact', 'img_url'=>'https://storage.googleapis.com/prod-storefront-static-files/38b6b4d0-a3c3-4eb6-a282-9dfe86dd8c20.png', 'url'=>'#'],
            ['title'=>'PUBG Mobile', 'img_url'=>'https://storage.googleapis.com/prod-storefront-static-files/1c7508f0-1e2c-4c08-9d3d-c17ee18f61e6.png', 'url'=>'#'],
            ['title'=>'Free Fire', 'img_url'=>'https://storage.googleapis.com/prod-storefront-static-files/7611474c-f6c9-4a87-b5b7-01c4aaaa4cc5.png', 'url'=>'#'],
            ['title'=>'Marvel: Super War', 'img_url'=>'https://storage.googleapis.com/prod-storefront-static-files/9ab53464-0a21-451d-866c-6f9e6683e1e3.png', 'url'=>'#'],
            ['title'=>'Valorant', 'img_url'=>'https://storage.googleapis.com/prod-storefront-files/f02f23de-8143-4660-8899-e49f8b92004a.png', 'url'=>'#'],
            ['title'=>'Steam Wallet', 'img_url'=>'https://storage.googleapis.com/prod-storefront-static-files/0b2c0962-ad8a-4b66-85e5-47b824fb332a.png', 'url'=>'#'],
            ['title'=>'Football Master', 'img_url'=>'https://storage.googleapis.com/prod-storefront-static-files/647604f4-1deb-4165-b30b-1378d0b52095.png', 'url'=>'#'],
            ['title'=>'Naruto Slugfest X', 'img_url'=>'https://storage.googleapis.com/prod-storefront-static-files/143612f9-1471-4024-9588-833c20b311b9.png', 'url'=>'#'],
            ['title'=>'Saint Seiya', 'img_url'=>'https://storage.googleapis.com/prod-storefront-static-files/4db266dd-3215-4d10-be9f-387c2ded1c94.png', 'url'=>'#'],
            ['title'=>'Life After', 'img_url'=>'https://storage.googleapis.com/prod-storefront-static-files/c9214dc2-a049-4587-82a9-b2a96cab41d8.png', 'url'=>'#'],
            ['title'=>'Fortnite', 'img_url'=>'https://storage.googleapis.com/prod-storefront-files/6236e18e-b77a-4cce-b063-691eed1d27a7.png', 'url'=>'#'],
        ];*/
        $games = Game::active()->get();
        return view('home', ['games' => $games]);
    }
}
