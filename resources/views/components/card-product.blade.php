@props([
    'product_code',
    'title',
    'price',
    'value'
])

<div class="col">
    <div {{ $attributes->class(['card product-card']) }} data-product-code="{{ $product_code ?? 'Kode' }}"
         data-code="{{ $product_code }}"
         data-price="{{ $price }}">
        <div class="card-body text-center">
            <h6>{{ $title ?? 'Nama Produk' }}</h6>
            @if($value > $price)
                <p class="text-decoration-line-through text-warning m-0"><small>Rp. {{ number_format($value) }}</small></p>
            @endif
            <p class="lh-1">Rp. {{ number_format($price ?? 0) }}</p>
        </div>
    </div>
</div>
