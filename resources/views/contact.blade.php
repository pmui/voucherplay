@extends('layouts.storefront',[
    'title' => config('app.name')." - Kontak Kami",
    'description' => 'Kontak VoucherPlay'
    ])

@section('content')
    <div class="container my-4">
        <h1 class="display-6 mb-4">Kontak Kami</h1>

        <h6>Kantor</h6>
        <p class="mb-4">Gd. Grha Prima Indonesia, Jl. Tuparev No.87, Sutawinangun, Kec. Kedawung, Kabupaten Cirebon, Jawa Barat 45153</p>

        <h6>Telp</h6>
        <p class="mb-4"><a href="tel:6231233500">(+6231) 233500</a></p>

        <h6>Email</h6>
        <p class="mb-4"><a href="mailto:cs@voucherplay.com">cs@voucherplay.com</a></p>

        <h6>WhatsApp</h6>
        <p class="mb-4"><a href="https://wa.me/6287860505051">+62 878-6050-5051</a></p>
    </div>
@endsection
