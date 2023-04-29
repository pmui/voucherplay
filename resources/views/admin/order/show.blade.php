@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Order Detail #123456</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Order Information:</strong></p>
                                <ul class="list-unstyled">
                                    <li><strong>ID:</strong> 123456</li>
                                    <li><strong>Date:</strong> 20 April 2023</li>
                                    <li><strong>Status:</strong> Paid</li>
                                    <li><strong>Email:</strong> johndoe@gmail.com</li>
                                    <li><strong>Game Account Name:</strong> JohnDoe123</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Game Information:</strong></p>
                                <ul class="list-unstyled">
                                    <li><strong>Title:</strong> Call of Duty: Mobile</li>
                                    <li><strong>Code:</strong> CODM</li>
                                    <li><strong>Type:</strong> Voucher</li>
                                    <li><strong>Image:</strong> <img src="https://example.com/image.jpg" alt="Product Image" class="img-fluid"></li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Product Information:</strong></p>
                                <ul class="list-unstyled">
                                    <li><strong>Code:</strong> ABC123</li>
                                    <li><strong>Name:</strong> Call of Duty: Mobile Voucher $10</li>
                                    <li><strong>Price:</strong> $10</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Payment Information:</strong></p>
                                <ul class="list-unstyled">
                                    <li><strong>Subtotal:</strong> $10</li>
                                    <li><strong>Discount:</strong> $0</li>
                                    <li><strong>Admin Fee:</strong> $1</li>
                                    <li><strong>Payment Method:</strong> Bank Transfer</li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <p><strong>Order Log:</strong></p>
                        <ul class="list-unstyled">
                            <li>Order created: 20 April 2023 10:00 AM</li>
                            <li>Order paid: 20 April 2023 10:30 AM</li>
                            <li>Order completed: 20 April 2023 11:00 AM</li>
                        </ul>
                        <button class="btn btn-primary">Resend Email</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
