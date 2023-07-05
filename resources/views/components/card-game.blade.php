@props([
    'game'
])

<a href="{{ route('top-up', $game) }}" {{ $attributes->class(['text-decoration-none']) }}>

    <div class="col">

        <div class="card mb-2 card-game">
            @if($game->discount_info)
                <div class="position-absolute badge bg-main rounded-start-0 shadow-sm p-2 start-0-0 top-0" style="z-index: 999;">
                    <small>Disc s.d {{ number_format(round($game->discount_info/1000)) }}K</small>
                </div>
            @endif
                <img src="{{ $game->image_url }}" data-src="{{ $game->image_url ?? asset('images/logo.png') }}" class="card-img-top rounded" alt="{{ $game->title ?? 'Judul Game' }}" loading="lazy">
        </div>
        <span class="mt-2">{{ $game->title ?? 'Judul Game' }}</span>
    </div>
</a>

