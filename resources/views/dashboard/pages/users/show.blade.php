@extends('dashboard.layouts.master')
@section('title', 'Show User')
@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Show User</h1>


        <div class="card-body">
            <div class="row shadow-sm p-3 mb-5 bg-white rounded">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Name<span class="text-danger">*</span></label>
                        <input disabled type="text" class="form-control" id="name" value="{{old('name',$user->name)}}">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username">User Name<span class="text-danger">*</span></label>
                        <input disabled type="text" class="form-control" id="username" value="{{old('username',$user->username)}}">
                        @error('username')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone">Phone <span class="text-danger">*</span></label>
                        <input disabled type="tel" class="form-control" id="phone" value="{{old('phone',$user->phone)}}">
                        @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input disabled type="text" class="form-control" id="email" value="{{old('email',$user->email)}}">
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status">Status <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" disabled value="{{$user->status}}">

                        @error('status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email_verified_at">Email Verified <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" disabled value="{{$user->email_verified_at}}">

                        @error('email_verified_at')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input disabled type="text" class="form-control" id="city" value="{{old('city', $user->city)}}">
                        @error('city')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="street">Street</label>
                        <input disabled type="text" class="form-control" id="street" value="{{old('street',$user->street)}}">
                        @error('street')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input disabled type="text" class="form-control" id="country" value="{{old('country',$user->country)}}">
                        @error('country')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection