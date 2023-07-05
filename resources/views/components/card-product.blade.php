@props([
    'product',
])

<div class="col">
    <div {{ $attributes->class(['card product-card']) }} data-product-code="{{ $product->product_code ?? 'Kode' }}"
         data-code="{{ $product->product_code }}"
         data-price="{{ $product->price }}"
         title="{{ $product->name }}"
    >
        <div class="card-body text-center">
            <h6>{{ $product->name ?? 'Nama Produk' }}</h6>
            @if($product->value > $product->price)
                <div class="position-absolute badge bg-main rounded-start-0 shadow-sm p-2 start-0 top-0" style="z-index: 999;">
                    <small>Disc Rp. {{ number_format($product->value - $product->price)  }}</small>
                </div>
                <p class="text-decoration-line-through text-warning m-0"><small>Rp. {{ number_format($product->value) }}</small></p>
            @endif
            <p class="lh-1">Rp. {{ number_format($product->price ?? 0) }}</p>
        </div>
    </div>
</div>
