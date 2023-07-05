@extends('layouts.storefront',['title' => config('app.name')." - Beranda"])

@section('content')
    <div class="container my-4">
        <h1 class="display-6 mb-4">Riwayat Pembelian</h1>

        @forelse($orders as $order)
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
                            <strong>Total:</strong> Rp {{ number_format($order->payment->total) }}
                        </p>
                    </div>
                    <div class="text-center">
                        <a class="text-decoration-none" href="#" data-bs-toggle="collapse" data-bs-target="#paymentDetails" role="button" aria-expanded="false" aria-controls="paymentDetails">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <a href="" class="">Order Sekarang</a>
        @endforelse



    </div>
@endsection
