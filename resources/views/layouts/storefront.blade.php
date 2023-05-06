<!doctype html>
<html lang="id" data-bs-theme="light">
<head>
    <title>{{ $title ?? config('app.name') }}</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div id="loading-overlay">
    <div id="loading-spinner"></div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark bg-main sticky-top">
    <div class="container d-flex align-items-center">
        <div class="d-flex">
            <button class="navbar-toggler d-block ml-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="logo" style="height: 48px">
            </a>
        </div>

        <div>
            <button class="btn btn-sm" title="Pencarian Game" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSearch" aria-controls="offcanvasSearch">
                <img src="https://img.icons8.com/ios-glyphs/30/FFFFFF/search--v1.png"/>
            </button>
            <button class="btn btn-sm" type="button" onclick="switchTheme()" title="Tema" data-bs-toggle="tooltip">
                <img id="theme-icon" src="https://img.icons8.com/material-outlined/30/FFFFFF/light-on--v1.png"/></button>
        </div>

    </div>
</nav>

<div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasSearch" aria-labelledby="offcanvasSearchLabel">
    <div class="container">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasSearchLabel">Search</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form action="">
                <input type="text" class="form-control form-control-lg" id="live-search" placeholder="Search...">

                <ul id="result" class="list-group mt-2 shadow-sm"></ul>
            </form>


        </div>
    </div>
</div>


<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="sidebarLabel">Menu</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div class="p-4">
            <p>
                Ayo segera daftar dan nikmati berbagai keuntungan yang bisa kamu dapatkan! Dengan mendaftar, kamu akan mendapatkan riwayat pembelian yang lengkap, promo eksklusif, dan berbagai keuntungan menarik lainnya.
            </p>

            <a href="#" class="btn btn-primary btn-accent w-100 p-2 mt-5">Daftar Sekarang</a>
        </div>
    </div>
</div>


<main>
    @yield('content')


    <footer class="" style="background-color: #02361b">
        <div class="container p-2">
            <span class="text-decoration-none mx-4 text-white" >&copy; 2023</span>
            <a class="text-decoration-none mx-4" href="{{ route('faq') }}">FAQ</a>
            <a class="text-decoration-none mx-4" href="{{ route('term-condition') }}">Syarat dan Ketentuan</a>
            <a class="text-decoration-none mx-4" href="{{ route('policy-privacy') }}">Kebijakan Privasi</a>
            <a class="text-decoration-none mx-4" href="{{ route('contact') }}">Kontak Kami</a>
        </div>

    </footer>
</main>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script>
    const savedMode = localStorage.getItem('colorScheme');
    const currentMode = savedMode ?? 'light';
    document.documentElement.setAttribute('data-bs-theme', currentMode);

    function switchTheme()
    {
        const currentScheme = document.documentElement.getAttribute('data-bs-theme');
        const btn = document.getElementById('theme-icon');
        const newScheme = currentScheme === 'light' ? 'dark' : 'light';


        if(currentScheme === 'light'){
            icon = 'https://img.icons8.com/material-outlined/30/FFFFFF/light-on--v1.png'
        }else{
            icon = 'https://img.icons8.com/material-outlined/30/FFFFFF/light-off--v1.png'
        }


        localStorage.setItem('colorScheme', newScheme);
        document.documentElement.setAttribute('data-bs-theme', newScheme);




    }

    $('#live-search').keyup(async function (e) {

        let url = '{{ route('ajax.game') }}/?q='+$(this).val();
        const response = await fetch(url);

        // Storing data in form of JSON
        var data = await response.json();
        if(data.length)
        {
            showResult(data)
        }else{
            $('#ul-result').html('<h5 class="m-2">Tidak ditemukan</h5>')
        }
    })



    function showResult(data)
    {
        var html = '';
        for (let r of data) {
            html += `<a href="{{ route('top-up') }}/${r.id}" class="list-group-item list-group-item-action" >
                    <div><img src="${r.image_url}" alt="" style="width: 64px" class="mr-2">
                    <span>${r.title}</span>
                    </div>
                    </a>`
        }
        $('#result').html(html)

    }

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
@stack('scripts')
</body>
</html>
