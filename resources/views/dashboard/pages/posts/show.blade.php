@extends('dashboard.layouts.master')
@section('title', 'Show Post Details')
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <style>
        .post-card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .post-header {
            background: #f8f9fc;
            border-bottom: 2px solid #4e73df;
            padding: 1.5rem;
        }

        .post-header h6 {
            color: #4e73df;
            font-weight: 600;
            margin: 0;
        }

        .post-body {
            padding: 1.5rem;
        }

        /* Swiper Styles */
        .swiper {
            width: 100%;
            height: 400px;
            margin-bottom: 2rem;
            border-radius: 0.35rem;
            overflow: hidden;
        }

        .swiper-slide {
            text-align: center;
            background: #f8f9fc;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #4e73df;
            background: rgba(255, 255, 255, 0.9);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 1.2rem;
        }

        .swiper-pagination-bullet-active {
            background: #4e73df;
        }

        .post-meta {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .post-meta i {
            width: 20px;
            text-align: center;
            margin-right: 0.5rem;
        }

        .post-content {
            color: #5a5c69;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .post-tags {
            margin-bottom: 1.5rem;
        }

        .post-tag {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: #e3e6f0;
            color: #4e73df;
            border-radius: 50rem;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
            font-size: 0.85rem;
        }

        .post-stats {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stat-item {
            display: flex;
            align-items: center;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .stat-item i {
            width: 20px;
            text-align: center;
            margin-right: 0.5rem;
            color: #4e73df;
        }

        .post-actions {
            border-top: 1px solid #e3e6f0;
            padding-top: 1.5rem;
            margin-top: 1.5rem;
        }

        .btn-icon-split {
            padding: 0.375rem 0.75rem;
            font-size: 0.9rem;
            margin-right: 0.5rem;
        }

        .btn-icon-split i {
            margin-right: 0.5rem;
        }

        .author-info {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: #f8f9fc;
            border-radius: 0.35rem;
        }

        .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 1rem;
            object-fit: cover;
        }

        .author-details h6 {
            margin: 0;
            color: #4e73df;
        }

        .author-details p {
            margin: 0;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .comment-section {
            margin-top: 2rem;
        }

        .comment-item {
            padding: 1rem;
            border-bottom: 1px solid #e3e6f0;
        }

        .comment-item:last-child {
            border-bottom: none;
        }

        .comment-header {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .comment-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 1rem;
            object-fit: cover;
        }

        .comment-meta {
            flex: 1;
        }

        .comment-author {
            font-weight: 600;
            color: #4e73df;
            margin: 0;
        }

        .comment-date {
            color: #6c757d;
            font-size: 0.85rem;
            margin: 0;
        }

        .comment-content {
            color: #5a5c69;
            margin: 0;
            padding-left: 3.5rem;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Post Details</h1>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-primary btn-icon-split">
                <span class="icon text-white">
                    <i class="fas fa-arrow-left"></i>
                </span>
                <span class="text">Back to Posts</span>
            </a>
        </div>

        <div class="row">
            <!-- Post Details Card -->
            <div class="col-lg-8">
                <div class="card post-card mb-4">
                    <div class="post-header">
                        <h6><i class="fas fa-newspaper mr-2"></i>Post Information</h6>
                    </div>
                    <div class="post-body">
                        <!-- Author Info -->
                        <div class="author-info">
                            <div class="author-details">
                                <h6>Publisher:
                                    <span class="text-primary">
                                        {{ auth()->guard('web')->user()->name ? auth()->guard('admin')->user()->name: 'By Admin' }}
                                    </span>
                                </h6>
                                <p><i class="fas fa-clock mr-1"></i>Posted <span class="text-primary">{{ $post->created_at->diffForHumans() }}</span>
                                </p>
                            </div>
                        </div>

                        <!-- Post Title -->
                        <h4 class="mb-3">{{ $post->title }}</h4>

                        <!-- Post Meta -->
                        <div class="post-meta">
                            <div><i class="fas fa-folder"></i>Category: {{ $post->category->name }}</div>
                            <div><i class="fas fa-eye"></i>Views: {{ $post->num_of_views }}</div>
                            <div><i class="fas fa-comments"></i>Comments: {{ $post->comments_count }}</div>
                        </div>

                        <!-- Post Images Slider -->
                        @if($post->images->count() > 0)
                            <div class="swiper post-images-slider">
                                <div class="swiper-wrapper">
                                    @foreach($post->images as $image)
                                        <div class="swiper-slide">
                                            <img src="{{ asset($image->path) }}" alt="Post Image">
                                        </div>
                                    @endforeach
                                </div>
                                <!-- Add Navigation -->
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                                <!-- Add Pagination -->
                                <div class="swiper-pagination"></div>
                            </div>
                        @endif

                        <!-- Post Content -->
                        <div class="post-content">
                            {!! $post->content !!}
                        </div>

                        <!-- Post Stats -->
                        <div class="post-stats">

                            <div class="stat-item">
                                <i class="fas fa-comment"></i>
                                <span>{{ $post->comments_count > 0 ? $post->comments_count.' Comments' : 'No Comments Yet' }}</span>
                            </div>

                        </div>

                        <!-- Post Actions -->
                        <div class="post-actions">
                            <a href="{{ route('admin.posts.edit', $post->id) }}"
                               class="btn btn-primary btn-icon-split">
                                <i class="fas fa-edit"></i>
                                <span>Edit Post</span>
                            </a>

                            <a href="{{ route('admin.post.status-change', $post->id) }}"
                               class="btn btn-warning btn-icon-split">
                                <i class="fas fa-{{ $post->status == 'active' ? 'ban' : 'check' }}"></i>
                                <span>{{ $post->status == 'active' ? 'Deactivate' : 'Activate' }}</span>
                            </a>

                            <a href="#"
                               data-toggle="modal"
                               data-target="#delete_post_{{$post->id}}"
                               class="btn btn-danger btn-icon-split">
                                <i class="fas fa-trash"></i>
                                <span>Delete Post</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Comments Section -->
                @if($post->comments->count() > 0)
                    <div class="card post-card">
                        <div class="post-header">
                            <h6><i class="fas fa-comments mr-2"></i>Comments ({{ $post->comments->count() }})</h6>
                        </div>
                        <div class="post-body">
                            @foreach($post->comments as $comment)
                                <div class="comment-item">
                                    <div class="comment-header">
                                        <img src="{{ asset($comment->user->image ?? 'assets/img/default-avatar.png') }}"
                                             alt="{{ $comment->user->name }}"
                                             class="comment-avatar">
                                        <div class="comment-meta">
                                            <h6 class="comment-author">{{ $comment->user->name }}</h6>
                                            <p class="comment-date">{{ $comment->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <p class="comment-content">{{ $comment->content }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Post Status Card -->
                <div class="card post-card mb-4">
                    <div class="post-header">
                        <h6><i class="fas fa-info-circle mr-2"></i>Post Status</h6>
                    </div>
                    <div class="post-body">
                        <div class="form-group">
                            <label class="font-weight-bold">Status</label>
                            <div>
                                <span class="badge badge-{{ $post->status == 'active' ? 'success' : 'danger' }}">
                                    {{ ucfirst($post->status) }}
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Published At</label>
                            <div>{{ $post->created_at->format('F j, Y g:i A') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Last Updated</label>
                            <div>{{ $post->updated_at->format('F j, Y g:i A') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Category Info Card -->
                <div class="card post-card mb-4">
                    <div class="post-header">
                        <h6><i class="fas fa-folder mr-2"></i>Category Information</h6>
                    </div>
                    <div class="post-body">
                        <div class="form-group">
                            <label class="font-weight-bold">Category Name</label>
                            <div>{{ $post->category->name }}</div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Category Description</label>
                            <div>{{ $post->category->description }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard.pages.posts.delete')
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Swiper('.post-images-slider', {
                // Enable loop if there are multiple images
                loop: {{ $post->images->count() > 1 ? 'true' : 'false' }},

                // Enable autoplay
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },

                // Navigation arrows
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },

                // Pagination
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },

                // Responsive breakpoints
                breakpoints: {
                    // when window width is >= 320px
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 20
                    },
                    // when window width is >= 480px
                    480: {
                        slidesPerView: 1,
                        spaceBetween: 30
                    },
                    // when window width is >= 640px
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 40
                    }
                }
            });
        });
    </script>
@endpush