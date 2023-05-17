@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="row mt-5">
            <h3 class="my-2"><i class="fa fa-gamepad mr-2"></i> <a href="{{ route('admin.game') }}" class="text-decoration-none" >Games</a>
                / <a href="{{ route('admin.game.show', $game) }}" class="text-decoration-none">{{ $game->code }}</a>
                / {{ $product->product_code }}</h3>
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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Edit {{ $product->product_code }}</strong>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.product.update', $product) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group mb-2 row">
                                <label><input type="checkbox" name="active" value="1" @if($product->active) checked @endif > Product active</label>
                            </div>
                            <div class="form-group mb-2 row">
                               <div class="col">
                                    <label>Name</label>
                               </div>
                                <div class="col">
                                    <input type="text" name="name" id="name" value="{{ $product->name }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group mb-2 row">
                               <div class="col">
                                    <label>Cost</label>
                               </div>
                                <div class="col">
                                    <input type="number" name="cost" id="cost" value="{{ $product->cost }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group mb-2 row">
                               <div class="col">
                                    <label>Value</label>
                               </div>
                                <div class="col">
                                    <input type="number" name="value" id="value" value="{{ $product->value }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group mb-2 row">
                               <div class="col">
                                    <label>Price</label>
                               </div>
                                <div class="col">
                                    <input type="number" name="price" id="price" value="{{ $product->price }}" class="form-control" required>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
