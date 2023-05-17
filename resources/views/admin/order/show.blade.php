@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="my-2"><i class="fa fa-shopping-cart mr-2"></i> <a href="{{ route('admin.order') }}" class="text-decoration-none" >Order</a>
                    / {{ $order->id }}</h3>
                <div class="card mt-5">
                    <div class="card-header">
                        <h4>Order Detail #{{ $order->id }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Order Information:</strong></p>
                                <ul class="list-unstyled">
                                    <li><strong>ID:</strong> {{ $order->id }}</li>
                                    <li><strong>Date:</strong> {{ $order->created_at }}</li>
                                    <li><strong>Status:</strong> {{ $order->status }}</li>
                                    <li><strong>Email:</strong> {{ $order->email }}</li>
                                    <li><strong>Game Account Name:</strong> {{ $order->id }}</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Game Information:</strong></p>
                                <ul class="list-unstyled">
                                    <li><img src="{{ $order->game->image_url }}" alt="{{ $order->game->title }}" class="img-fluid w-25"></li>
                                    <li><strong>Title:</strong> {{ $order->game->title }}</li>
                                    <li><strong>Code:</strong> {{ $order->game->code }}</li>
                                    <li><strong>Type:</strong> {{ $order->game->type }}</li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Product Information:</strong></p>
                                <ul class="list-unstyled">
                                    <li><strong>Code:</strong> {{ $order->product->product_code }}</li>
                                    <li><strong>Name:</strong> {{ $order->product->name }}</li>
                                    <li><strong>Price:</strong> {{ number_format($order->product->price) }}</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Payment Information:</strong></p>
                                <ul class="list-unstyled">
                                    <li><strong>Subtotal:</strong> {{ number_format($order->payment->subtotal) }}</li>
                                    <li><strong>Discount:</strong> {{ number_format($order->payment->discount) }}</li>
                                    <li><strong>Admin Fee:</strong> {{ number_format($order->payment->admin_fee) }}</li>
                                    <li><strong>Payment Method:</strong> <img src="{{ $order->payment->paymentMethod->image_url }}" alt="{{ $order->payment->paymentMethod->name }}" style="height: 16px"> {{ $order->payment->paymentMethod->name }}</li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <p><strong>Order Log:</strong></p>
                        <ul class="list-unstyled">
                            @foreach($activities as $log)
                                <li>{{ $log->created_at }} {{ $log->description }}</li>
                            @endforeach
                        </ul>
                        <button class="btn btn-primary">Resend Email</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
