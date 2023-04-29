@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h3 class="my-2"><i class="fa fa-shopping-cart mr-2"></i> Order</h3>

                <div class="card card-body">
                    <strong>Filter</strong>
                    <form method="get">
                        <div class="row">
                            <div class="col">
                                <label><i class="fa fa-calendar"></i> Date</label>
                                <input type="date" name="start_date" class="my-2 form-control" placeholder="Start Date">
                                <input type="date" name="end_date" class="my-2 form-control" placeholder="End Date">
                            </div>

                            <div class="col">
                                <label><i class="fa fa-gamepad"></i> Game</label>
                                <input type="text" name="game_code" class="my-2 form-control" placeholder="Geme Code">
                                <input type="text" name="product_code" class="my-2 form-control" placeholder="Product Code">
                            </div>

                            <div class="col">
                                <label><i class="fa fa-user"></i> Cutomer</label>
                                <input type="number" name="phone" class="my-2 form-control" placeholder="Phone">
                                <input type="email" name="email" class="my-2 form-control" placeholder="Email">
                            </div>

                            <div class="col align-self-center">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <table class="table my-5">
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
@endsection
