@extends('frontend.layouts.master')
@section('title', $mainPost->title)
@push('header_meta')
    <link rel="canonical" href="{{ url()->full() }}"/>
@endpush
{{--<meta content="index , follow" name="robots"/>--}}

{{--Meta tags--}}
@section('meta_content')
    <meta content="{{$mainPost->meta_title}}" name="meta_title"/>
    <meta content="{{$mainPost->meta_description}}" name="meta_description"/>
@endsection

<!-- Breadcrumb Start -->
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">{{$mainPost->title}}</li>
@endsection
<!-- Breadcrumb End -->

@section('content')

    <!-- Single News Start-->
    <div class="single-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Carousel -->
                    <div id="newsCarousel" class="carousel slide" data-ride="carousel">

                        <ol class="carousel-indicators">
                            <li data-target="#newsCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#newsCarousel" data-slide-to="1"></li>
                            <li data-target="#newsCarousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">

                            @foreach($mainPost->images as $key=> $image)
                                <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                                    <img style="height: 300px" src="{{asset($image->path)}}" class="d-block w-100" alt="First Slide">
                                    <div class="carousel-caption d-none d-md-block"
                                         style="background: rgba(0,0,0,0.5); padding: 10px; border-radius: 5px;">
                                        <h5 style="color: #fff; text-shadow: 1px 1px 2px rgba(0,0,0,0.8);">{!! $mainPost->title !!}</h5>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#newsCarousel" role="button" data-slide="prev"
                           style="background: linear-gradient(to right, rgba(0,0,0,0.8), transparent); width: 10%;">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#newsCarousel" role="button" data-slide="next"
                           style="background: linear-gradient(to left, rgba(0,0,0,0.5), transparent); width: 10%;">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <div class="sn-content">
                        <div style="word-wrap: break-word;">{!! $mainPost->description !!}</div>
                    </div>

                    <!-- Comment Section -->
                    <div class="comment-section">
                        <!-- Comment Input -->
                        @auth
                            @if($mainPost->comment_able == true)
                                <form action="{{ route('frontend.post.comments.store') }}" method="post" id="commentForm">
                                    <div class="comment-input">
                                        @csrf
                                        <input type="text" name="comment" placeholder="Add a comment..." title="comment" id="commentInput"/>
                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                        <input type="hidden" name="post_id" value="{{$mainPost->id}}">
                                        <button type="submit">Post</button>
                                    </div>
                                </form>
                            @else
                                <div class="alert alert-info">
                                    <strong>Info!</strong> Comments are disabled for this post.
                                </div>
                            @endif
                        @endauth
                        @guest
                            <div class="alert alert-info">
                                <strong>Info!</strong> You need to <a class="font-weight-bold" href="{{ route('login') }}">login</a> to post a
                                comment.
                            </div>
                        @endguest
                        <div style="display: none" id="errorMsg" class="alert alert-danger">
                            {{-- display errors--}}
                        </div>
                        <!-- Display Comments -->
                        <div class="comments">
                            @foreach($mainPost->comments as $comment)
                                <div class="comment">
                                    <img src="{{asset($comment->user->image)}}" alt="User Image" class="comment-img"/>
                                    <div class="comment-content">
                                        <span class="username">{{@$comment->user->name}}</span>
                                        <p class="comment-text">{{@$comment->comment}}</p>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <!-- Show More Button -->
                        @if($mainPost->comments->count() > 3)
                            <button id="showMoreBtn" class="show-more-btn">Show more</button>
                        @endif
                    </div>

                    <!-- Related News -->
                    <div class="sn-related">
                        <h2>Related News</h2>
                        <div class="row sn-slider">
                            @foreach($relatedPosts as $post)

                                <div class="col-md-4">
                                    <div class="sn-img">
                                        <img src="{{$post->images->first()->path}}" class="img-fluid" title="{{$post->title}}"
                                             alt="{{$post->title}}"/>
                                        <div class="sn-title">
                                            <a href="{{ route('frontend.post.show',$post->slug) }}" title="{{$post->title}}">{{$post->title}}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="sidebar-widget">
                            <h2 class="sw-title">In This Category</h2>
                            <div class="news-list">

                                @foreach($relatedPosts as $post)
                                    <div class="nl-item">
                                        <div class="nl-img">
                                            <img style="width: 90px; height:70px" src="{{$post->images->first()->path}}" alt="{{$post->title}}"/>
                                        </div>
                                        <div class="nl-title">
                                            <a href="{{ route('frontend.post.show',$post->slug) }}">{{$post->title}}</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>


                        <div class="sidebar-widget">
                            <div class="tab-news">
                                <ul class="nav nav-pills nav-justified">
                                    <li class="nav-item active">
                                        <a class="nav-link active"
                                           data-toggle="pill" href="#popular">Popular</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#latest">Latest</a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    {{-- latest posts --}}
                                    <div id="popular" class="container tab-pane fade">
                                        @foreach($latest_posts as $post)
                                            <div class="tn-news">
                                                <div class="tn-img">
                                                    <img style="width: 90px; height:70px" src="{{asset($post->images->first()->path)}}"
                                                         alt="{{$post->title}}"/>
                                                </div>
                                                <div class="tn-title">
                                                    <a href="{{ route('frontend.post.show',$post->slug) }}" title="{{$post->title}}">
                                                        {{$post->title}}
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    {{-- popular_posts_comments --}}
                                    <div id="latest" class="container tab-pane fade">
                                        @foreach($popular_posts_comments as $post)
                                            <div class="tn-news">
                                                <div class="tn-img">
                                                    <img style="width: 90px; height:70px" src="{{$post->images->first()->path}}"
                                                         alt="{{$post->title}}"/>
                                                </div>
                                                <div class="tn-title">
                                                    <a href="{{ route('frontend.post.show',$post->slug) }}" title="{{$post->title}}">
                                                        {{$post->title}}
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <h2 class="sw-title">News Category</h2>
                            <div class="category">
                                <ul>
                                    @foreach($categories as $category)
                                        <li><a href="">{{$category->name}}</a><span>({{$category->posts->count()}})</span></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single News End-->

@endsection

@push('js')
    <script>
        {{-- Show more comments --}}
        $(document).on('click', '#showMoreBtn', function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('frontend.post.getAllComments',$mainPost->slug)}}",
                type: "GET",

                success: function (data) {
                    $('.comment').empty();
                    $.each(data, function (key, comment) {
                        $('.comments').append(`
                           <div class="comment">
                                <img src="${comment.user.image}" alt="User Image" class="comment-img"/>
                                 <div class="comment-content">
                                <span class="username">${comment.user.name}</span>
                                <p class="comment-text">${comment.comment}</p>
                           </div>
                        `);

                        $('#showMoreBtn').hide();
                    });
                },
                error: function (data) {
                    console.log(data)
                }
            })
        });

        {{-- Post comment --}}
        $(document).on('submit', '#commentForm', function (e) {
            e.preventDefault();
            let formData = new FormData($(this)[0]);
            $('#commentInput').val('');

            $.ajax({
                url: "{{route('frontend.post.comments.store')}}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,

                success: function (data) {
                    $('#errorMsg').hide();
                    $('.comments').prepend(`
                       <div class="comment">
                                <img src="${data.comment.user.image}" alt="${data.comment.user.name}" class="comment-img"/>
                                 <div class="comment-content">
                                <span class="username">${data.comment.user.name}</span>
                                <p class="comment-text">${data.comment.comment}</p>
                       </div>
                    `)
                },
                error: function (data) {
                    let response = $.parseJSON(data.responseText);
                    $('#errorMsg').text(response.errors.comment).show();
                }
            })
        })
    </script>
@endpush