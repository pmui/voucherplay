@php
    $payment_methods = \App\Models\PaymentMethod::where('active',1)->get();
@endphp

<div class="card my-4">
    <div class="card-body">
        <h5 class="heading accent-color">Pilih Metode Pembayaran</h5>

        @foreach($payment_methods->groupBy('category') as $category => $methods)
            <h6 class="mt-4">{{ $category }}</h6>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-3 g-4 mt-2 mb-2">

                @foreach($methods as $method)
                    <div class="col">
                        <div class="card h-100 payment-method-option"
                             data-method="{{ $method->name }}"
                             data-fee="{{ $method->fee_amount }}"
                             data-fee-percent="{{ $method->fee_percent }}"
                             data-calculated-fee="0">

                            <div class="card-body text-center">
                                <img src="{{ $method->image_url }}" alt="{{ $method->name }}" class="img-fluid">
                                <p class="mt-2 lh-1 subtotal"></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
