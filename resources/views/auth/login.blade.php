@extends('frontend.layouts.master')
@section('title', 'Login')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Login</li>
@endsection

@section('content')
    <div class="container py-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow border-0">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0"><i class="fas fa-sign-in-alt me-2"></i>Login</h4>
                    </div>
                    <div class="card-body p-4">
                        <a href="{{ route('auth.socialite.redirect','facebook') }}" class="btn btn-primary w-100 mb-2"
                           style="background:#1877f3;border:none;">
                            <i class="fab fa-facebook-f me-2"></i> Login with Facebook
                        </a>
                        <a href="{{ route('auth.socialite.redirect','google') }}" class="btn btn-outline-danger w-100">
                            <i class="fab fa-google me-2"></i> Login with Google
                        </a>
                        <div class="text-center my-4">
                            <span class="text-muted">or login with email</span>
                        </div>
                        <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                            @csrf
                            <div class="mb-3">
                                <label for="login" class="form-label">Email or Username</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="login" name="email"
                                       value="{{ old('email') }}" required autofocus>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                                       required>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <button type="submit" class="btn btn-warning px-4">Login</button>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot password?</a>
                                @endif
                            </div>
                            <div class="text-center">
                                <p class="mb-0">Don't have an account?
                                    <a href="{{ route('register') }}" class="text-decoration-none text-primary">
                                        Register here
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection