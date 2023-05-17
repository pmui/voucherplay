@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h3 class="my-2"><i class="fa fa-gamepad mr-2"></i> <a href="{{ route('admin.game') }}" class="text-decoration-none" >Games</a>
        / {{ $game->code }}</h3>
        <div class="row mt-5">
            <div class="col-md-3">
                <img src="{{ $game->image_url }}" alt="Game Image" class=" w-100 img-fluid">
            </div>
            <div class="col-md-9">
                <h1>{{ $game->title }}</h1>
                <h4>Type:</h4>
                <p>{{ $game->type }}</p>
                <h4>Description:</h4>
                <p>{{ $game->description }}</p>
                <h4>Terms and Conditions:</h4>
                <p>{{ $game->tnc }}</p>
                <h4>Status:</h4>
                <p class="text-success">Active</p>
                <!-- or p class="text-danger">Not Available</p> -->
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Products</strong>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>CODE</th>
                                <th>NAME</th>
                                <th>COST</th>
                                <th>PRICE</th>
                                <th>ACTIVE</th>
                                <th>ACTION</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($game->products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->product_code }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ number_format($product->price) }}</td>
                                    <td>{{ number_format($product->price) }}</td>
                                    <td>{{ $product->active }}</td>
                                    <td><a href="{{ route('admin.product.edit',[$game, $product]) }}">Edit</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
