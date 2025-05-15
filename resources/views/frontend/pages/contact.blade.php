@extends('frontend.layouts.master')
@section('title', 'Contact Us')
@push('header_meta')
    <link rel="canonical" href="{{ url()->full() }}"/>
@endpush
{{--<meta content="index , follow" name="robots"/>--}}

<!-- Breadcrumb Start -->
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Contact</li>
@endsection
<!-- Breadcrumb End -->

@section('content')

    <!-- Contact Start -->
    <div class="contact">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="contact-form">
                        <form action="{{ route('frontend.contact.store') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder="Your Name"/>
                                </div>
                                @error('name')
                                {{ $message }}
                                @enderror
                                <div class="form-group col-md-6">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" placeholder="Your Email"/>
                                    @error('email')
                                    <span class="text-danger">  {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Phone<span class="text-danger">*</span></label>
                                <input type="tel" name="phone" class="form-control" placeholder="Phone"/>
                            </div>
                            <div class="form-group">
                                <label>Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" placeholder="Title"/>
                                @error('title')
                                <span class="text-danger">  {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Your Message Body <span class="text-danger">*</span></label>
                                <textarea class="form-control" rows="5" name="body" placeholder="Body"></textarea>
                                @error('body')
                                <span class="text-danger">  {{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <button class="btn" type="submit">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-info">
                        <h3>{{$getSetting->site_name}}</h3>
                        <p class="mb-4">
                            The contact form is currently inactive. Get a functional and
                            working contact form with Ajax & PHP in a few minutes. Just copy
                            and paste the files, add a little code and you're done.
                        </p>
                        <h4><i class="fa fa-map-marker"></i>{{$getSetting->street}} , {{$getSetting->city}} , {{$getSetting->country}}</h4>
                        <h4><i class="fa fa-envelope"></i>{{$getSetting->site_email}}</h4>
                        <h4><i class="fa fa-phone"></i>{{$getSetting->site_phone}}</h4>
                        <div class="social">
                            <a target="_blank" href="{{$getSetting->twitter_link}}" title="twitter"><i class="fab fa-twitter"></i></a>
                            <a target="_blank" href="{{$getSetting->facebook_link}}" title="facebook"><i class="fab fa-facebook-f"></i></a>
                            <a target="_blank" href="{{$getSetting->linkedin_link}}" title="linkedin"><i class="fab fa-linkedin-in"></i></a>
                            <a target="_blank" href="{{$getSetting->instagram_link}}" title="instagram"><i class="fab fa-instagram"></i></a>
                            <a target="_blank" href="{{$getSetting->youtube_link}}" title="youtube"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

@endsection