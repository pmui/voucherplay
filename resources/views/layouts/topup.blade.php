<!doctype html>
<html lang="en">
<head>
    <title>StoreFront</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        .card:hover .icon{
            transform: scale(1.1);
            transition: all .2s ease-in-out;
        }
    </style>
</head>
<body class="bg-dark">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">LOGO</a>

        <div class="mx-auto">
            <form action="">
                <input type="search" name="search" id="search" class="form-control form-control-lg w-100" placeholder="Cari judul game">
            </form>
        </div>
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="#">Login</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false">Dropdown</a>
                <div class="dropdown-menu" aria-labelledby="dropdownId">
                    <a class="dropdown-item" href="#">Action 1</a>
                    <a class="dropdown-item" href="#">Action 2</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<div class="container my-4">
    <div class="row">
        <div class="col-md-6">
            <div class="card text-white my-4 bg-secondary">
                <div class="w-50 mx-auto p-4">
                    <img class="card-img-top" src="https://storage.googleapis.com/prod-storefront-static-files/0e3e84d6-ed14-4aff-a760-6debd07bc14e.png" alt="">
                </div>
                <div class="card-body">
                    <h4 class="card-title">Mobile Legend</h4>
                    <p class="my-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa cum dolore doloremque iste, itaque repudiandae sapiente. Corporis dolorum facere ipsa, ipsum labore modi mollitia necessitatibus pariatur provident quas quis repudiandae!</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card text-white my-4 bg-secondary">
                <div class="card-body">
                    <h3>Masukan Informasi</h3>

                    <input type="email" class="form-control form-control-lg my-2" placeholder="Masukan Email">
                    <input type="email" class="form-control form-control-lg my-2" placeholder="Konfirmasi Email">
                </div>
            </div>

            <div class="card text-white my-4 bg-secondary">
                <div class="card-body">
                    <h3>Pilih Nominal</h3>

                    <div class="row">
                        <div class="col-4">
                            <x-card-product :product_code="'AX5'" :title="'10 Diamonds'" :price="10000"/>
                        </div>

                        <div class="col-4">
                            <x-card-product :product_code="'AX5'" :title="'10 Diamonds'" :price="10000"/>
                        </div>

                        <div class="col-4">
                            <x-card-product :product_code="'AX5'" :title="'10 Diamonds'" :price="10000"/>
                        </div>

                        <div class="col-4">
                            <x-card-product :product_code="'AX5'" :title="'10 Diamonds'" :price="10000"/>
                        </div>

                        <div class="col-4">
                            <x-card-product :product_code="'AX5'" :title="'10 Diamonds'" :price="10000"/>
                        </div>

                        <div class="col-4">
                            <x-card-product :product_code="'AX5'" :title="'10 Diamonds'" :price="10000"/>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card text-white my-4 bg-secondary">
                <div class="card-body">
                    <h3>Metode Pembayaran</h3>

                    <input type="email" class="form-control form-control-lg my-2" placeholder="Masukan Email">
                    <input type="email" class="form-control form-control-lg my-2" placeholder="Konfirmasi Email">
                </div>
            </div>

            <div class="card text-white my-4 bg-secondary">
                <div class="card-body">
                    <h3>Konfirmasi Pesanan</h3>

                    <table class="table">
                        <tr>
                            <td>Produk</td>
                            <td><strong>Nama Produk</strong></td>
                        </tr>
                        <tr>
                            <td>Harga Produk</td>
                            <td class="text-right">Rp. 10,000</td>
                        </tr>
                        <tr>
                            <td>Biaya Admin</td>
                            <td class="text-right">Rp. 200</td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td class="text-right"><strong class="text-warning">Rp. 10.200</strong></td>
                        </tr>
                    </table>

                    <hr>
                    <button class="btn btn-primary btn-block btn-lg">Lanjutkan</button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <footer class="p-2 text-center text-white">
        <p>&copy; {{ date('Y') }} PT Prima Digital Indonesia</p>
    </footer>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>
