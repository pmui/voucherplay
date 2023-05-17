@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h3 class="my-2"><i class="fa fa-gamepad mr-2"></i> Games</h3>

                <div class="card mt-5">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>CODE</th>
                                <th>GAME</th>
                                <th>TYPE</th>
                                <th>ACTIVE</th>
                                <th>PRODUCTS</th>
                                <th>ACTION</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($games as $game)
                                <tr>
                                    <td>{{ $game->id }}</td>
                                    <td>{{ $game->code }}</td>
                                    <td>{{ $game->title }}</td>
                                    <td>{{ $game->type }}</td>
                                    <td>{{ $game->active }}</td>
                                    <td>{{ $game->products_count }}</td>
                                    <td><a href="{{ route('admin.game.show', $game) }}">Mange</a></td>
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
