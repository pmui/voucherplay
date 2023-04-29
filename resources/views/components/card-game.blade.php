@props([
    'url',
    'image_url',
    'title'
])

<a href="{{ $url ?? '# '}}" {{ $attributes->class(['text-decoration-none']) }}>

    <div class="col">
        <div class="card h-100 rounded card-game accent-color">
            <img src="{{ $image_url ?? asset('images/logo.png') }}" class="card-img-top rounded-top" alt="{{ $title ?? 'Judul Game' }}">
            <div class="card-body">
                <h6 class="card-title text-base">{{ $title ?? 'Judul Game' }}</h6>
            </div>
        </div>
    </div>
</a>

