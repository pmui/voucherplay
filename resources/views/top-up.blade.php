@extends('layouts.storefront')

@section('content')
    <div class="d-md-none py-4 ">
        {{--Mobile--}}
        <div class="container my-4">
            <div class="d-flex">
                <div class="w-25 rounded">
                    <img src="{{ $game->image_url }}" alt="{{ $game->title }}" class="img-fluid rounded">
                </div>
                <div class="p-2">
                    <h4 class="heading">{{ $game->title }}</h4>
                    @if($game->type === 'top-up')
                        <span>Direct Top Up</span>
                    @else
                        <span>Voucher</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="container my-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-2 d-md-block d-none">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ $game->image_url }}" alt="{{ $game->title }}" class="img-fluid w-50 rounded">
                        </div>
                        <h4 class="heading my-4">{{ $game->title }}</h4>
                        <div class="alert alert-info my-2 p-1">
                            @if($game->type === 'top-up')
                                <span>Produk akan langsung masuk ke account game Kamu</span>
                            @else
                                <span>Kamu akan mendapatkan kode voucher untuk kamu redeem</span>
                            @endif
                        </div>

                        <div class="">
                            <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis debitis delectus ducimus error eum expedita, facilis ipsum iste laborum modi nisi praesentium quidem repudiandae similique soluta sunt temporibus voluptates voluptatum.</p>

                            <h5 class="mt-2">Cara Top-Up</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis debitis delectus ducimus error eum expedita, facilis ipsum iste laborum modi nisi praesentium quidem repudiandae similique soluta sunt temporibus voluptates voluptatum.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <form id="form-top-up" action="{{ route('co') }}" method="POST">
                    @csrf
                    @if($game->validation_fields)
                        <div class="card mb-2">
                            <div class="card-body">
                                <h5 class="heading accent-color mb-4">Akun Game</h5>
                                <div class="row my-2">

                                    @foreach(json_decode($game->validation_fields) as $field)
                                        @switch($field->type)
                                            @case('integer')
                                                <div class="col">
                                                    <input type="number" required name="account[{{$field->name}}]"  class="form-control form-control-lg" placeholder="{{ strtoupper($field->name) }}">
                                                </div>
                                                @break

                                            @case('dropdown')
                                                <div class="col">
                                                    <select class="form-control form-control-lg" name="account[{{$field->name}}]" required>
                                                        <option value="">Pilih {{$field->name}}</option>
                                                        @foreach($field->data as $opt)
                                                            <option value="{{ $opt->value }}">{{ $opt->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                @break

                                            @default
                                                <div class="col">
                                                    <input type="text" required name="account[{{$field->name}}]"  class="form-control form-control-lg" placeholder="{{ strtoupper($field->name) }}">
                                                </div>
                                                @break
                                        @endswitch
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif


                    <div class="card mb-2">
                        <div class="card-body">
                            <h5 class="heading accent-color mb-4">Pilih Item</h5>

                            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-3 g-4">

                                @foreach($game->products as $product)
                                    <div class="col-4">
                                        <x-card-product :product_code="$product->product_code" :title="$product->name" :price="$product->price"/>
                                    </div>
                                @endforeach


                            </div>
                        </div>
                    </div>


                    @include('_payment_options')


                    <div class="card mb-2">
                        <div class="card-body">
                            <h5 class="heading accent-color">Email</h5>
                            <p>Kami akan mengirimkan bukti pembayaran dan kode voucher ke email Anda</p>

                            <input required type="email" name="email" id="email" class="form-control form-control-lg">
                        </div>
                    </div>


                    <input type="hidden" name="product_code" id="product_code" value="">
                    <input type="hidden" name="product_price" id="product_price" value="0">
                    <input type="hidden" name="payment_method" id="payment_method" value="">
                    <input type="hidden" name="admin_fee" id="admin_fee" value="0">


                    <button type="button" class="w-100 btn btn-accent btn-lg" id="confirm">LANJUTKAN</button>
                </form>

            </div>
        </div>
    </div>

    <div class="d-md-none mt-4 mb-2 p-2">
        <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis debitis delectus ducimus error eum expedita, facilis ipsum iste laborum modi nisi praesentium quidem repudiandae similique soluta sunt temporibus voluptates voluptatum.</p>

        <h5 class="mt-2">Cara Top-Up</h5>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis debitis delectus ducimus error eum expedita, facilis ipsum iste laborum modi nisi praesentium quidem repudiandae similique soluta sunt temporibus voluptates voluptatum.</p>
    </div>

    <!-- Button trigger modal -->



    <!-- Modal -->
    <div class="modal fade" id="modalNotif" tabindex="-1" role="dialog" aria-labelledby="modalNotif" aria-hidden="true">
        <div class="modal-dialog h-100 d-flex flex-column justify-content-center my-0" role="dialog">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h5 class="my-4" id="alert-msg">Harap pilih produk sebelum memilih metode pembayaran</h5>

                    <button type="button" class="btn btn-lg btn-primay" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalConfirm" tabindex="-1" aria-labelledby="modalConfirmLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalConfirmLabel">Konfirmasi Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Anda akan melakukan pembayaran dengan rincian sebagai berikut:</p>
                    <ul>
                        <li>User ID: <span id="i_username"></span></li>
                        <li>Items: <span id="i_product"></span></li>
                        <li>Metode Pembayaran: <span id="i_payment_method"></span></li>
                        <li>Harga: <span id="i_price"></span></li>
                        <li>Biaya Admin: <span id="i_fee"></span></li>
                        <li>Total: <h4 class="text-warning my-2" id="i_total">0</h4></li>
                    </ul>
                    <p>Apakah Anda yakin ingin melanjutkan?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="$('#form-top-up').submit()">Lanjutkan</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(function() {
            const productCard = $('.product-card');
            const paymentMethodOption = $('.payment-method-option');
            const productCode = $('#product_code');
            const productPrice = $('#product_price');
            const paymentMethod = $('#payment_method');
            const adminFee = $('#admin_fee');

            productCard.click((e) => {
                $('.selected-card').removeClass('selected-card');
                $(e.currentTarget).addClass('selected-card');
                productCode.val($(e.currentTarget).data('code'));
                productPrice.val($(e.currentTarget).data('price'));
                removePayment();
                calculateAdminFee($(e.currentTarget).data('price'));
            });

            function showNotif(msg) {
                $('#modalNotif #alert-msg').text(msg)
                $('#modalNotif').modal('show')


            }

            paymentMethodOption.click((e) => {
                if (!productCode.val()) {
                    showNotif('Pilih Produk terlebih dahulu');
                    return false;
                }
                $('.selected-payment-card').removeClass('selected-payment-card');
                $(e.currentTarget).addClass('selected-payment-card');

                paymentMethod.val($(e.currentTarget).data('method'));
                adminFee.val($(e.currentTarget).data('calculated-fee'));
            });

            $('#confirm').click((e) => {
                e.preventDefault();
                if (!isFormValid()) {
                    showNotif('Sialakan pilih produk dan petode pembayaran');
                    return
                }
                let next = false;

                if ($('input[name*="account"]').length) {
                    validateAccount().then((data) => {
                        if(data.status == 'valid') {
                            next = true;
                        }

                        if (next) {
                            $('#modalConfirm #i_username').text(data.username);
                            showConfirmationModal();
                        }else{
                            showNotif('User/Account Invalid. Mohon periksa kembali data akun yang kamu masukan');
                        }
                    }).catch(() => {
                        alert('User invalid');
                    });
                } else {
                    next = true;

                    if (next) {
                        showConfirmationModal();
                    }
                }
            });

            function isFormValid() {
                const productCode = $('#product_code').val();
                const paymentMethod = $('#payment_method').val();
                const email = $('#email').val()
                if (!productCode || !paymentMethod || !email) {
                    showNotif('Silakan pilih produk metode pembayaran dan email');
                    return false;
                }
                return true;
            }

            function showConfirmationModal() {
                $('#modalConfirm #i_product').text(productCode.val());
                $('#modalConfirm #i_price').text(numberFormat(productPrice.val()));
                $('#modalConfirm #i_payment_method').text(paymentMethod.val());
                $('#modalConfirm #i_fee').text(numberFormat(adminFee.val()));
                $('#modalConfirm #i_total').text(numberFormat(+adminFee.val() + +productPrice.val()));
                $('#modalConfirm').modal('show');
            }

            function calculateAdminFee(amount) {
                paymentMethodOption.each((index, element) => {
                    let fee;
                    if ($(element).data('fee-percent')) {
                        fee = +(productPrice.val() * $(element).data('fee-percent') / 100);
                        console.log('using percent fee')
                    } else {
                        fee = $(element).data('fee');
                        console.log('using fixed fee')
                    }
                    fee = Math.round(fee);
                    let subtotal = +productPrice.val() + fee;
                    $(element).find('.subtotal').text(numberFormat(subtotal));
                    $(element).data('calculated-fee', fee);
                });
            }

            function removePayment() {
                paymentMethod.val('');
                adminFee.val(0);
                paymentMethodOption.removeClass('selected-payment-method');
            }

            function numberFormat(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            function validateAccount() {
                console.log('validate account...');
                var data = $('#form-top-up').serializeArray();
                console.log(data)
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#loading-overlay').show(); // Show the loading layer before sending the Ajax request.

                return new Promise(function(resolve, reject) {
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('ajax.validate-account') }}',
                        data: data,
                        dataType: 'json',
                        success: function(data) {
                            resolve(data);
                        },
                        error: function(err) {
                            reject(err);
                        },
                        complete: function() {
                            $('#loading-overlay').hide(); // Hide the loading layer after the Ajax request completes.
                            console.log('request complete.');
                        }
                    });
                });
            }

        })

    </script>
@endpush
