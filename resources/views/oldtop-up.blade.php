@extends('layouts.storefront')

@section('content')
    <div class="container my-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card text-white my-4 bg-secondary">
                    <div class="w-50 mx-auto p-4">
                        <img class="card-img-top" src="{{ $game->image_url }}" alt="{{ $game->title }}">
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">{{ $game->title }}</h4>
                        <span class="badge badge-primary p-2">Top Up</span>
                        <div class="alert alert-info my-2">
                            @if($game->type === 'top-up')
                                <p>Produk akan langsung masuk ke account game Kamu</p>
                            @else
                                <p>Kamu akan mendapatkan kode voucher untuk kamu redeem</p>
                            @endif
                        </div>
                        <p class="my-4">{{ $game->description }}</p>
                    </div>
                </div>

            </div>

            <div class="col-md-6">
                <form id="form-top-up" method="POST" action="{{ route('co') }}">
                    @csrf
                    @if($game->validation_fields)
                        <div class="card text-white my-4 bg-secondary">
                            <div class="card-body">
                                <h3>Masukan Informasi Akun</h3>
                                @foreach(json_decode($game->validation_fields) as $field)
                                    @switch($field->name)
                                        @case('integer')
                                            <input type="number" name="account[{{$field->name}}]" class="form-control form-control-lg my-2" placeholder="{{$field->name}}">
                                            @break

                                        @case('dropdown')
                                            <select class="form-control" name="account[{{$field->name}}]">


                                            </select>

                                            @break

                                        @default
                                            <input type="text" name="account[{{$field->name}}]" class="form-control form-control-lg my-2" placeholder="{{$field->name}}">
                                            @break
                                    @endswitch
                                @endforeach
                                <small class="text-warning my-2">Kami tidak bertanggung jawab jika terjadi kesalahan penginputan data akun</small>
                            </div>
                        </div>
                    @endif

                    <div class="card text-white my-4 bg-secondary">
                        <div class="card-body">
                            <h3>Pilih Nominal</h3>

                            <div class="row">
                                @foreach($game->products as $product)
                                    <div class="col-4">
                                        <x-card-product :product_code="$product->product_code" :title="$product->name" :price="$product->price"/>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="card text-white my-4 bg-secondary">
                        <div class="card-body">
                            <h3>Metode Pembayaran</h3>
                            @include('_payment_options')
                        </div>
                    </div>

                    <div class="card text-white my-4 bg-secondary">
                        <div class="card-body">
                            <h3>Kontak Email</h3>

                            <input type="email" class="form-control form-control-lg my-2" placeholder="Masukan Email">
                            <input type="email" class="form-control form-control-lg my-2" placeholder="Konfirmasi Email">
                            <small class="text-warning my-2">Kode Voucher akan dikirimkan ke email tersebut</small>
                        </div>
                    </div>


                    <input type="hidden" name="product_code" id="product_code" value="">
                    <input type="hidden" name="product_price" id="product_price" value="0">
                    <input type="hidden" name="payment_method" id="payment_method" value="">
                    <input type="hidden" name="admin_fee" id="admin_fee" value="0">
                    <button type="submit" class="btn btn-primary btn-block btn-lg" id="confirm">Lanjutkan</button>

                </form>
            </div>

        </div>
    </div>

    <!-- Button trigger modal -->



    <!-- Modal -->
    <div class="modal fade" id="modalNotif" tabindex="-1" role="dialog" aria-labelledby="modalNotif" aria-hidden="true">
        <div class="modal-dialog h-100 d-flex flex-column justify-content-center my-0" role="dialog">
            <div class="modal-content bg-secondary text-white">
                <div class="modal-body text-center">
                    <h5 class="my-4" id="alert-msg">Harap pilih produk sebelum memilih metode pembayaran</h5>

                    <button type="button" class="btn btn-lg btn-primay" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="modalConfirm" aria-hidden="true">
        <div class="modal-dialog h-100 d-flex flex-column justify-content-center my-0" role="dialog">
            <div class="modal-content bg-secondary text-white">
                <div class="modal-header">
                    <h4>Detail Pesanan</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-borderless text-white">
                        <tr>
                            <td>Username</td>
                            <td><strong id="i_username">Nama Produk</strong></td>
                        </tr>
                        <tr>
                            <td>Produk</td>
                            <td><strong id="i_product">Nama Produk</strong></td>
                        </tr>
                        <tr>
                            <td>Metode Pembayaran</td>
                            <td><span id="i_payment_method"></span></td>
                        </tr>
                        <tr>
                            <td>Harga Produk</td>
                            <td class="text-right"><span id="i_price"></span></td>
                        </tr>
                        <tr>
                            <td>Biaya Admin</td>
                            <td class="text-right"><span id="i_fee"></span></td>
                        </tr>
                        <tr>

                            <td class="text-center py-2 border rounded" colspan="2">
                                <span>Total</span>
                                <h4 class="text-warning my-2" id="i_total">0</h4>
                            </td>
                        </tr>
                    </table>
                    <div class="text-center">
                        <button type="button" class="btn btn-lg btn-primary btn-block" onclick="$('#form-top-up').submit()">Bayar</button>
                        <button type="button" class="btn btn-lg btn-primay" data-dismiss="modal">Tutup</button>
                    </div>
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
                $('.selected-product').toggleClass('bg-primary bg-dark').removeClass('selected-product');
                $(e.currentTarget).toggleClass('bg-primary bg-dark').addClass('selected-product');
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
                $('.selected-payment-method').toggleClass('bg-primary').removeClass('selected-payment-method');
                $(e.currentTarget).toggleClass('bg-primary').addClass('selected-payment-method');
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
                if (!productCode || !paymentMethod) {
                    showNotif('Silakan pilih produk dan metode pembayaran');
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
                    } else {
                        fee = $(element).data('fee');
                    }
                    fee = Math.round(fee);
                    let subtotal = +productPrice.val() + fee;
                    $(element).children('span').last().text(numberFormat(subtotal));
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
                            console.log('Ajax request complete.');
                        }
                    });
                });
            }

        })

    </script>
@endpush
