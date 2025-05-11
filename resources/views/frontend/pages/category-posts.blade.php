@extends('frontend.layouts.master')
@section('title', 'Category Posts')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">{{$category->name}}</li>
@endsection
@section('content')
    <div class="main-news mt-4">
        <div class="container mt-4">
            <div class="row mt-4">
                <div class="col-lg-9">
                    <div class="row">
                        @forelse($posts as $post)
                            <div class="col-md-4">
                                <div class="mn-img">
                                    <img style="width: 254px; height:134px " src="{{asset($post->images->first()->path)}}" alt="{{$post->title}}"/>
                                    <div class="mn-title">
                                        <a href="{{ route('frontend.post.show',$post->slug) }}" title="{{$post->title}}">{{$post->title}}</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-md-12 text-center">
                                <div class="alert alert-danger">
                                    <strong>No posts found in this category.</strong>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    {{$posts->links()}}
                </div>

                <div class="col-lg-3">
                    <div class="mn-list">
                        <h2 style="font-size: 25px!important;">Other Categories</h2>
                        <ul>
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('frontend.category.posts',$category->slug) }}"
                                       title="{{$category->name}}">{{$category->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection