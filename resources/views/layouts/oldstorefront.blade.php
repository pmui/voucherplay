<!doctype html>
<html lang="en">
<head>
    <title>StoreFront</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        .card:hover .icon{
            transform: scale(1.1);
            transition: all .2s ease-in-out;
        }
        .form-control:focus
        {
            outline: none !important;
            box-shadow: none;
        }

        .mac-style{
            width: 200px;
            -webkit-transition: width .25s ease-in-out;
            -moz-transition:width .25s ease-in-out;
            -o-transition: width .25s ease-in-out;
            transition: width .25s ease-in-out;
            float:right;
            padding: 10px 40px;
        }

        .mac-style:focus{
            width: 500px;
        }

        nav label {
            position: relative;

        }

        nav label:before {
            content: "";
            position: absolute;
            left: 10px;
            top: 0;
            bottom: 0;
            width: 20px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='25' height='25' viewBox='0 0 25 25' fill-rule='evenodd'%3E%3Cpath d='M16.036 18.455l2.404-2.405 5.586 5.587-2.404 2.404zM8.5 2C12.1 2 15 4.9 15 8.5S12.1 15 8.5 15 2 12.1 2 8.5 4.9 2 8.5 2zm0-2C3.8 0 0 3.8 0 8.5S3.8 17 8.5 17 17 13.2 17 8.5 13.2 0 8.5 0zM15 16a1 1 0 1 1 2 0 1 1 0 1 1-2 0'%3E%3C/path%3E%3C/svg%3E") center / contain no-repeat;
        }

        #search-result {
            position:absolute;
            min-width: 500px;
            display: none;
        }
        form:focus-within + #search-result, #search-result:hover {
            display: block;
        }

        #loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9998;
        }

        #loading-spinner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 50px;
            height: 50px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            z-index: 9999;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

    </style>
</head>
<body class="bg-dark">
<div id="loading-overlay">
    <div id="loading-spinner"></div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <i class="fas fa-gamepad"></i> LOGO
        </a>

        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item mr-2">
                <form action="">
                    <label>
                        <input class="form-control border-left-0 border form-control-lg" placeholder="Cari game" type="search"  id="live-search" style="padding: 10px 40px">
                    </label>
                </form>

                <div class="bg-white rounded" id="search-result">
                    <div class="list-group" id="ul-result">

                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-user"></i> Login
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false">
                    <i class="fas fa-bars"></i> Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownId">
                    <a class="dropdown-item" href="#">Action 1</a>
                    <a class="dropdown-item" href="#">Action 2</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<main>
    @yield('content')
</main>
<div class="container">
    <footer class="p-2 text-center text-white">
        <p>&copy; {{ date('Y') }} PT Prima Digital Indonesia</p>
    </footer>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script nomodule="" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>

<script>
    $(function (){
        /*$('#live-search').focus(function (e){
            $('#search-result').show(250)
        })

        $('#live-search').blur(function (e){
            $('#search-result').hide(250)
        })*/

        $('#live-search').keyup(async function (e) {

            let url = '{{ route('ajax.game') }}/?q='+$(this).val();
            const response = await fetch(url);

            // Storing data in form of JSON
            var data = await response.json();
            console.log(data);

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
            $('#ul-result').html(html)
        }
    })
</script>

@stack('scripts')
</body>
</html>
