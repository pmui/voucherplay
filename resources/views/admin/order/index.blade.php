@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h3 class="my-2"><i class="fa fa-shopping-cart mr-2"></i> Order</h3>

                <div class="card card-body mt-5">
                    <strong>Filter</strong>
                    <form method="get">
                        <div class="row">
                            <div class="col">
                                <label><i class="fa fa-calendar"></i> Date</label>
                                <input type="date" name="start_date" class="my-2 form-control" placeholder="Start Date" value="{{ request('start_date') ?? date('Y-m-d') }}">
                                <input type="date" name="end_date" class="my-2 form-control" placeholder="End Date" value="{{ request('end_date') ?? date('Y-m-d') }}">
                            </div>

                            <div class="col">
                                <label><i class="fa fa-gamepad"></i> Game</label>
                                <input type="text" name="game_code" class="my-2 form-control" placeholder="Geme Code" value="{{ request('game_code') ?? '' }}">
                                <input type="text" name="product_code" class="my-2 form-control" placeholder="Product Code" value="{{ request('product_code') ?? '' }}">
                            </div>

                            <div class="col">
                                <label><i class="fa fa-user"></i> Cutomer</label>
                                <input type="number" name="phone" class="my-2 form-control" placeholder="Phone" value="{{ request('phone') ?? '' }}">
                                <input type="email" name="email" class="my-2 form-control" placeholder="Email" value="{{ request('email') ?? '' }}">
                            </div>

                            <div class="col align-self-center">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card mt-2">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>DATETIME</th>
                                <th>ID</th>
                                <th>CUSTOMER</th>
                                <th>GAME</th>
                                <th>PRODUCT</th>
                                <th>STATUS</th>
                                <th>Detail</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->game_code }}</td>
                                    <td>{{ $order->product_code }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td><a href="{{ route('admin.order.detail', $order) }}">Tampilkan</a></td>
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
