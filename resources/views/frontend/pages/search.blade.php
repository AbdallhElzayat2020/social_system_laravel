@extends('frontend.layouts.master')
@section('title','Search Posts')
@push('header_meta')
    <link rel="canonical" href="{{ url()->full() }}"/>
@endpush
<meta content="index , follow" name="robots"/>

@section('content')
    <!-- Main News Start-->
    <div class="main-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        @forelse($posts as $post)
                            <div class="col-md-4">
                                <div class="mn-img">
                                    <img src="{{asset($post->images->first()->path)}}" alt="{{$post->title}}"/>
                                    <div class="mn-title">
                                        <a href="{{ route('frontend.post.show',$post->slug) }}">{{$post->title}}</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-md-12 text-center">
                                <div class="alert alert-danger">
                                    <strong>No posts found for this search.</strong>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <div class="d-flex align-items-center justify-content-center">
                        {{$posts->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main News End-->
@endsection