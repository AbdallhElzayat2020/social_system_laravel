@extends('dashboard.layouts.auth.master')
@section('title','Dashboard | Forget Password')
@section('body')
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center align-items-center">

            <div class="col-xl-10 col-lg-12 col-md-12">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="p-5">

                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Forgot Password</h1>
                                    </div>

                                    <form class="user" method="post" action="{{ route('admin.password.send-otp') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" name="email" value="{{old('email')}}" class="form-control form-control-user"
                                                   id="exampleInputEmail" aria-describedby="emailHelp"
                                                   placeholder="Enter Email Address...">
                                            @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Send
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection