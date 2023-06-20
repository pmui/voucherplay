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
                <span class="card-title text-base">{{ $title ?? 'Judul Game' }}</span>
            </div>
        </div>
    </div>
</a>

