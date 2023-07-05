@extends('layouts.storefront',[
    'title' => config('app.name')." - Detail Pesanan #".$order->id,
])

@section('content')
    <main class="container my-4">
        <h4 class="heading accent-color my-4">Detail Pesanan</h4>

        @if($order->status == 'waiting payment')
            <div class="alert alert-danger text-center">
                <p>Harap selesaikan pembayaran sebelum</p>
                <h5>{{ date('l, d F Y H:i', strtotime($order->payment->expire)) }}</h5>
            </div>
        @endif

        <div class="d-flex justify-content-between w-100">
            <div class="">
                <span>IDTRX {{ str_pad($order->id,6) }}</span>
                @switch($order->status)
                    @case('success')
                        <span class="badge bg-success">Sukses</span>
                        @break

                    @case('failed')
                        <span class="badge bg-danger">Gagal</span>
                        @break

                    @case('paid')
                        <span class="badge bg-info">Sudah Dibayar</span>
                        @break

                    @default
                        <span class="badge bg-warning">Belum Bayar</span>
                        @break

                @endswitch
            </div>

            <div class="">
                <small class="text-muted">{{ $order->created_at->diffForHumans() }}</small>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card my-2 bg-light">
                    <div class="card-body d-flex align-items-center">
                        <div class="col text-center border-end">
                            <img class="w-25 img-fluid mb-2" src="{{ $order->product->game->image_url }}" alt="{{ $order->product->game->title }}"><br>
                            <h6 class="align-middle">{{ $order->product->game->title }}</h6>
                            <span>{{ $order->product->name }}</span>
                        </div>
                        <div class="col text-center">
                            <img src="{{ $order->payment->paymentMethod->image_url }}" alt="{{ $order->payment->paymentMethod->name }}" height="30"><br>
                            <h5 class="accent-color fs-2">Rp. {{ number_format($order->payment->total) }}</h5>
                        </div>
                    </div>
                    <div class="bg-white  p-2 rounded">
                        <div class="collapse" id="paymentDetails">
                            <p>
                                <strong>Subtotal:</strong> Rp {{ number_format($order->payment->subtotal) }}<br>
                                <strong>Fee:</strong> Rp {{ number_format($order->payment->admin_fee) }}<br>
                                <strong>Discount:</strong> Rp 0<br>
                                <strong>Total:</strong> Rp {{ number_format($order->payment->total) }}
                            </p>
                        </div>
                        <div class="text-center">
                            <a class="text-decoration-none" href="#" data-bs-toggle="collapse" data-bs-target="#paymentDetails" role="button" aria-expanded="false" aria-controls="paymentDetails">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">

                @if($order->status == 'waiting payment')
                    <div class="text-center">
                        @isset($order->payment->va_number)
                            <div class="border rounded my-2 p-2">
                                <p>Selesaikan pembayaran dengan melakukan transfer ke Virtual Akun berikut ini</p>
                                <h4 class="fs-1 fw-lighter ">{{ $order->payment->va_number }}</h4>

                                @if($order->status == 'waiting payment')
                                    <a href="" class="btn btn-accent mt-2">Cek Pembayaran</a>
                                @endif
                            </div>
                        @endisset
                        @isset($order->payment->links)
                            @foreach(json_decode($order->payment->links) as $link)
                                @if($link->name === 'generate-qr-code')
                                    <img class="p-4 img-fluid w-50" src="{{ $link->url }}" />
                                    <p>Scan QR di atas melalui aplikasi Gopay untuk melanjutkan pembayaran.</p>
                                @endif

                                @if($link->name === 'deeplink-redirect')
                                    <p>Atau jika Anda ingin membayar langsung di aplikasi silakan klik tombol di bawah ini. Pastikan aplikasi <strong>{{ $order->payment->paymentMethod->name }}</strong> sudah terinstall di perangkat Anda.</p>

                                    <a href="{{ $link->url }}" class="btn btn-accent btn-lg w-100">Buka di Aplikasi</a>
                                @endif
                            @endforeach
                        @endisset



                    </div>
                @endif

                @if($order->status == 'success')
                    <div class="text center">
                        <p class="my-2">Transaksi Anda telah berhasil! Bukti pembayaran @if($order->product->game->type == 'voucher') dan kode voucher @endif telah dikirim ke alamat email Anda. Jangan lupa untuk memeriksa folder spam jika tidak menemukan email tersebut di kotak masuk Anda. </p>
                        <form action="{{ route('order.resend', $order) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-accent w-100 mt-2">KRIM ULANG EMAIL</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>

        <div class="alert alert-info mt-5 text-center">
            <p>Halaman akan otomatis diperbarui ketika pembayaran berhasil dilakukan.</p>
            <p><a href="">Klik disini untuk memperbarui halaman secara manual</a></p>
        </div>


    </main>
@endsection
