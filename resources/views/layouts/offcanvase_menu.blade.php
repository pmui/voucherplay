<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="sidebarLabel">Menu</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div class="p-4">
            @guest
                <!-- Display for guest -->

                <p>
                    Ayo segera daftar dan nikmati berbagai keuntungan yang bisa kamu dapatkan! Dengan mendaftar, kamu
                    akan mendapatkan riwayat pembelian yang lengkap, promo eksklusif, dan berbagai keuntungan menarik
                    lainnya.
                </p>

                <a href="{{ route('register') }}" class="btn  btn-accent w-100 p-2 mt-5">Daftar Sekarang</a>
                <p class="mt-5">Sudah punya akun?</p>
                <a href="{{ route('login') }}" class="btn btn-outline-primary w-100 p-2">Login</a>
            @else
                <!-- Display for authenticated user -->

                <div class="card mb-2 border-0">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <img class="img-fluid rounded-circle" src="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name='.auth()->user()->name }}" alt="avatar">
                            </div>
                            <div class="col">
                                <h5 class="card-title">{{ auth()->user()->name }}</h5>
                                <p class="card-text">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action" href="{{ route('history') }}">Riwayat Pembelian</a>
{{--                    <a class="list-group-item list-group-item-action" href="#">Promos</a>--}}
{{--                    <a class="list-group-item list-group-item-action" href="#">Profil</a>--}}
                </div>
                <form action="{{ route('logout') }}" method="POST" class="sticky-bottom">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-accent w-100 p-2 mt-5">Logout</button>
                </form>
            @endguest

        </div>
    </div>
</div>
