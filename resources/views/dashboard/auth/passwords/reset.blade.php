@extends('dashboard.layouts.auth.master')
@section('title', 'Dashboard | Reset Password')
@section('body')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-12">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Reset Password</h1>
                                    </div>

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form class="user" method="post" action="{{ route('admin.password.reset-password') }}">
                                        @csrf
                                        <input type="hidden" name="email" value="{{ $email }}">

                                        {{--                                        <div class="form-group">--}}
                                        {{--                                            <input type="email" name="email" value="{{ $email }}" class="form-control">--}}
                                        {{--                                        </div>--}}

                                        <div class="form-group">
                                            <input type="password" name="password"
                                                   class="form-control form-control-user @error('password') is-invalid @enderror"
                                                   placeholder="New Password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <input type="password" name="password_confirmation"
                                                   class="form-control form-control-user"
                                                   placeholder="Confirm Password">
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Reset Password
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('admin.show-login-form') }}">Back to Login</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection