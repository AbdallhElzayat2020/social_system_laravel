@extends('frontend.layouts.master')
@section('title', 'Home')
@section('content')
    @php
        $latest_three_posts =$posts->take(3);
    @endphp
    {{--<!-- Top News Start-->--}}
    <div class="top-news">
        <div class="container">
            <div class="row">
                <div class="col-md-6 tn-left">
                    <div class="row tn-slider">
                        @foreach($latest_three_posts as $post)
                            <div class="col-md-6">
                                <div class="tn-img">
                                    <img src="{{asset('assets/frontend/img/news-450x350-1.jpg')}}" alt="{{$post->title}}"/>
                                    <div class="tn-title">
                                        <a href="">{{$post->title}}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6 tn-right">
                    @php
                        $four_posts=$posts->take(4);
                    @endphp
                    <div class="row">
                        @foreach($four_posts as $post)
                            <div class="col-md-6">
                                <div class="tn-img">
                                    <img src="{{asset('assets/frontend/img/news-350x223-1.jpg')}}" alt="{{$post->title}}"/>
                                    <div class="tn-title">
                                        <a href="">{{$post->title}}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Top News End-->

    <!-- Category News Start-->
    <div class="cat-news">
        <div class="container">
            <div class="row">
                @foreach($categories_with_posts as $category)
                    <div class="col-md-6">
                        <h2>{{@$category->name}}</h2>
                        <div class="row cn-slider">
                            @foreach($category->posts as $post)

                                <div class="col-md-6">
                                    <div class="cn-img">
                                        <img src="{{asset('assets/frontend')}}/img/news-350x223-1.jpg" alt="{{$post->title}}"/>
                                        <div class="cn-title">
                                            <a href="">{{@$post->title}}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Category News End-->

    <!-- Tab News Start-->
    <div class="tab-news">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#featured">Oldest News</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#popular">Popular News</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="featured" class="container tab-pane active">
                            @foreach($oldest_posts as $post)
                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img src="{{asset('assets/frontend')}}/img/news-350x223-1.jpg" alt="{{$post->title}}"/>
                                    </div>
                                    <div class="tn-title">
                                        <a href="">{{$post->title}}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div id="popular" class="container tab-pane fade">
                            @foreach($popular_posts as $post)
                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img src="{{asset('assets/frontend')}}/img/news-350x223-4.jpg" alt="{{$post->title}}"/>
                                    </div>
                                    <div class="tn-title">
                                        <a href="">{{$post->title}} ({{$post->comments_count }} <i class="fa-solid fa-comment"></i>)</a>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#m-viewed">Latest Posts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#m-read">Most Read</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        {{-- Content Latest News--}}
                        <div id="m-viewed" class="container tab-pane active">
                            @foreach($latest_three_posts as $post)

                                <div class="tn-news">
                                    <div class="tn-img">
                                        {{--<img src="{{$post->images->first()->path}}" alt="{{$post->title}}"/>--}}

                                        <img src="{{asset('assets/frontend')}}/img/news-350x223-5.jpg" alt="{{$post->title}}"/>
                                    </div>
                                    <div class="tn-title">
                                        <a href="">{{$post->title}}</a>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <div id="m-read" class="container tab-pane fade">
                            @foreach($greatest_posts_views as $post)
                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img src="{{asset('assets/frontend')}}/img/news-350x223-2.jpg" alt="{{$post->title}}"/>
                                    </div>
                                    <div class="tn-title">
                                        <a href="">{{$post->title}} ({{$post->num_of_views}} <i class="fa-solid fa-eye"></i>)</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tab News Start-->

    <!-- Main News Start-->
    <div class="main-news">
        <div class="container">
            <div class="row">

                <div class="col-lg-9">
                    <div class="row">
                        @foreach($posts as $post)
                            <div class="col-md-4">
                                <div class="mn-img">
                                    <img src="{{asset('assets/frontend')}}/img/news-350x223-1.jpg" alt="{{$post->title}}"/>
                                    <div class="mn-title">
                                        <a href="">{{$post->title}}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="d-flex align-items-center justify-content-center">
                            {{$posts->links()}}
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="mn-list">
                        <h2>Read More</h2>
                        <ul>
                            @foreach($read_more_posts as $post)

                                <li><a href="">{{$post->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main News End-->

@endsection