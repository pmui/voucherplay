@extends('layouts.storefront',['title' => config('app.name')." - Beranda"])

@section('content')
    <div class="container my-4">
        <h1 class="display-6 mb-4">Riwayat Pembelian</h1>

        <ul class="list-group list-group-flush">
        @forelse($orders as $order)
            <li class="list-group-item">
                <div>
                    <strong>{{ $order->product->game->title }}</strong><br>
                    <span>{{ $order->product->name }}</span>
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
            </li>
        @empty
            <a href="" class="">Order Sekarang</a>
        @endforelse
        </ul>



    </div>
@endsection
