@extends('layouts.storefront',[
    'title' => config('app.name')." - Daftar",
    'description' => 'Ayo segera daftar dan nikmati berbagai keuntungan yang bisa kamu dapatkan! Dengan mendaftar, kamu akan mendapatkan riwayat pembelian yang lengkap, promo eksklusif, dan berbagai keuntungan menarik lainnya.'
    ])


@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <h1>Masuk</h1>
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="mb-3">
                        <a href="{{ route('google.login') }}" class="btn btn-outline-secondary w-100 p-2 rounded-0">
                            <img src="https://img.icons8.com/color/16/000000/google-logo.png" class="me-2" alt="Google Logo">
                            Lanjutkan dengan Google
                        </a>
                    </div>

                    <div class="separator">
                        <hr class="separator-line">
                        <span class="separator-text">Atau masuk dengan email</span>
                        <hr class="separator-line">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan alamat email" value="{{ old('email') }}">
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <div class="input-group">
                            <input type="password" class="password form-control" name="password" placeholder="Masukkan kata sandi">
                            <button class="btn btn-outline-secondary togglePassword" type="button">Tampilkan Password</button>
                        </div>
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-accent w-100 mt-2">Login</button>
                    </div>
                </form>

                <p class="mt-5">Belum punya akun?</p>
                <a href="{{ route('login') }}" class="btn btn-outline-primary w-100 p-2">Daftar</a>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const togglePasswords = document.querySelectorAll('.togglePassword');
        const passwords = document.querySelectorAll('.password');

        togglePasswords.forEach(function(togglePassword, index) {
            togglePassword.addEventListener('click', function () {
                const type = passwords[index].getAttribute('type') === 'password' ? 'text' : 'password';
                passwords[index].setAttribute('type', type);
                this.innerHTML = type === 'password' ? 'Tampilkan Password' : 'Sembunyikan Password';
            });
        });
    </script>
@endpush



