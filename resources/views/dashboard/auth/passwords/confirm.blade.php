@extends('dashboard.layouts.auth.master')
@section('title','Dashboard | Confirm')
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
                                        <h1 class="h4 text-gray-900 mb-4">Enter you Verification Code</h1>
                                    </div>
                                    <form class="user" method="post" action="{{ route('admin.password.verify-otp') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input hidden type="email" name="email" value="{{$email}}" class="form-control form-control-user"
                                                   id="exampleInputEmail" aria-describedby="emailHelp">
                                            @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="token" class="form-control form-control-user"
                                                   id="exampleInputPassword" placeholder="token">
                                            @error('token')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Check
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