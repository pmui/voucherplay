@extends('layouts.storefront')

@section('content')

    <div class="container my-4">
        <div>
            <h4 class="heading accent-color my-4">Trending</h4>
            <div class="row row-cols-3 row-cols-md-4 row-cols-lg-6 g-4">
                @foreach($games->take(6) as $game)
                    <div class="col-4 col-md-2">
                        <x-card-game :url="route('top-up', $game)" :image_url="$game->image_url" :title="$game->title"/>
                    </div>
                @endforeach
            </div>
        </div>

        <div>
            <h4 class="heading accent-color my-4">Voucher</h4>
            <div class="row row-cols-3 row-cols-md-4 row-cols-lg-6 g-4">
                @foreach($games->where('type','voucher') as $game)
                    <div class="col-4 col-md-2">
                        <x-card-game :url="route('top-up', $game)" :image_url="$game->image_url" :title="$game->title"/>
                    </div>
                @endforeach
            </div>
        </div>

        <div>
            <h4 class="heading accent-color my-4">Direct Top Up</h4>
            <div class="row row-cols-3 row-cols-md-4 row-cols-lg-6 g-4">
                @foreach($games->where('type','top-up') as $game)
                    <div class="col-4 col-md-2">
                        <x-card-game :url="route('top-up', $game)" :image_url="$game->image_url" :title="$game->title"/>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


@endsection
