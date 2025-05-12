@extends('frontend.layouts.master')
@section('title', 'Profile')

@section('content')
    <br>
    <br>
    <!-- Profile Start -->
    <div class="dashboard container">
        <!-- Sidebar -->
        <aside class="col-md-3 nav-sticky dashboard-sidebar">
            <!-- User Info Section -->
            <div class="user-info text-center p-3">
                <img src="{{asset(auth()->guard('web')->user()->image)}}" alt="User Image" class="rounded-circle mb-2"
                     style="width: 80px; height: 80px; object-fit: cover"/>
                <h5 class="mb-0" style="color: #ff6f61">{{auth()->guard('web')->user()->name}}</h5>
            </div>

            <!-- Sidebar Menu -->
            <div class="list-group profile-sidebar-menu">
                <a href="{{ route('frontend.dashboard.profile') }}" class="list-group-item list-group-item-action active menu-item"
                   data-section="profile"> <i class="fas fa-user"></i> Profile
                </a>
                <a href="./notifications.html" class="list-group-item list-group-item-action menu-item" data-section="notifications">
                    <i class="fas fa-bell"></i> Notifications
                </a>
                <a href="./setting.html" class="list-group-item list-group-item-action menu-item" data-section="settings">
                    <i class="fas fa-cog"></i> Settings
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Profile Section -->
            <section id="profile" class="content-section active">
                <h2>User Profile</h2>
                <div class="user-profile mb-3">
                    <img src="{{asset(auth()->guard('web')->user()->image)}}" alt="User Image" class="profile-img rounded-circle"
                         style="width: 100px; height: 100px;"/>
                    <span class="username">{{(auth()->guard('web')->user()->name)}}</span>
                </div>
                <br>

                @if(session()->has('errors'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach(session('errors')->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Add Post Section -->
                <form action="{{ route('frontend.dashboard.post.store') }}" method="post" enctype="multipart/form-data" multiple="">
                    @csrf
                    <section id="add-post" class="add-post-section mb-5">
                        <h2>Add Post</h2>
                        <div class="post-form p-3 border rounded">
                            <!-- Post Title -->
                            <input type="text" id="postTitle" name="title" value="{{old('title')}}" class="form-control mb-2"
                                   placeholder="Post Title"/>
                            @error('title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <!-- Post Content -->
                            <textarea id="postContent" name="description" class="form-control mb-2" style="margin-bottom: 5px!important;" rows="3"
                                      placeholder="What's on your mind?">{{old('description')}}</textarea>
                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <!-- Image Upload -->
                            <input type="file" id="postImage" name="images[]" class="form-control my-2" style="margin-top: 10px!important;"
                                   accept="image/*"
                                   multiple/>
                            @error('images')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="tn-slider mb-2">
                                <div id="imagePreview" class="slick-slider"></div>
                            </div>

                            <!-- Category Dropdown -->
                            <select id="postCategory" name="category_id" class="form-select my-2">
                                {{-- categories comming from ViewServicesProvider --}}
                                @foreach($categories as $category)
                                    <option @selected(old('category_id', $category->id) == $category->id) value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <!-- Enable Comments Checkbox -->
                            <label class="form-check-label mb-2 mt-3" style="margin-left: 20px">
                                <input type="checkbox" name="comment_able" class="form-check-input"/> Enable Comments
                            </label><br>
                            @error('comment_able')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <!-- Post Button -->
                            <button type="submit" class="btn btn-primary post-btn">Post</button>
                        </div>
                    </section>
                </form>

                <!-- Posts Section for User -->
                <section id="posts" class="posts-section">
                    <h2>Recent Posts</h2>
                    <div class="post-list">
                        <!-- Post Item -->
                        @forelse($posts as $post)

                            <div class="post-item mb-4 p-3 border rounded">
                                <div class="post-header d-flex align-items-center mb-2">
                                    <img src="{{asset($post->images->first()->path)}}" alt="User Image" class="rounded-circle"
                                         style="width: 50px; height: 50px;"/>
                                    <div class="ms-3">
                                        <h5 class="mb-0">{{$post->user->name}}</h5>
                                    </div>
                                </div>
                                <h4 class="post-title" style="word-wrap: break-word;">{{$post->title}}</h4>
                                <p class="post-content" style="word-wrap: break-word !important; overflow-wrap: break-word; white-space: pre-wrap;">
                                    {!! chunk_split($post->description , 60) !!}
                                </p>

                                <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#newsCarousel" data-slide-to="0" class="active"></li>
                                        <li data-target="#newsCarousel" data-slide-to="1"></li>
                                        <li data-target="#newsCarousel" data-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel-inner">

                                        @foreach($post->images as $key=> $image)
                                            <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                                                <img style="height: 300px" src="{{asset($image->path)}}" class="d-block w-100" alt="First Slide">
                                                <div class="carousel-caption d-none d-md-block"
                                                     style="background: rgba(0,0,0,0.5); padding: 10px; border-radius: 5px;">
                                                    <h5 style="color: #fff; text-shadow: 1px 1px 2px rgba(0,0,0,0.8);">{!! $post->title !!}</h5>
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
                                <div class="post-actions d-flex justify-content-between">
                                    <div class="post-stats">
                                        <!-- View Count -->
                                        <span class="me-3">
                                        <i class="fas fa-eye"></i> {{$post->num_of_views}}
                                        </span>
                                    </div>
                                    <div>
                                        <a href="{{ route('frontend.dashboard.post.edit',$post->slug) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>

                                        <a onclick="if (confirm('Are you Sure to delete This post?')) {
                                                 document.getElementById('deleteForm_{{$post->id}}').submit();
                                            } return false"
                                           href="javascript:void(0)" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-thumbs-up"></i> Delete
                                        </a>

                                        <button class="btn getComments btn-sm btn-outline-secondary" post-id="{{$post->id}}">
                                            <i class="fas fa-comment"></i> Comments
                                        </button>

                                        <form id="deleteForm_{{$post->id}}" action="{{ route('frontend.dashboard.post.delete') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="slug" value="{{$post->slug}}">
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </div>

                                <!-- Display Comments -->
                                <div id="displayComments_{{$post->id}}" class="comments mt-3" style="display: none">
                                    <div class="comment">
                                        <img src="{{asset('uploads/users/ali-20031746896952.png')}}" alt="User Image" class="comment-img"/>
                                        <div class="comment-content">
                                            <span class="username"></span>
                                            <p class="comment-text">first comment</p>
                                        </div>
                                    </div>
                                    <!-- Add more comments here for demonstration -->
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info">
                                <strong>No posts found!</strong> You haven't created any posts yet.
                            </div>
                        @endforelse

                        <!-- Add more posts here dynamically -->
                    </div>
                </section>
            </section>
        </div>
    </div>
    <br>
    <br>
    <br>
    <!-- Profile End -->
@endsection

@push('js')
    <script>
        $(function () {
            $('#postImage').fileinput({
                theme: 'fa5',
                allowFileTypes: ['jpg', 'png', 'jpeg'],
                maxFileCount: 3,
                enableResumableUpload: false,
                showUpload: false,
            })


            $('#postContent').summernote({
                height: 300,
            });

            /* get post comments */
            $(document).on('click', '.getComments', function (e) {
                e.preventDefault();
                let postId = $(this).attr('post-id');

                $.ajax({
                    type: 'GET',
                    url: '{{route('frontend.dashboard.post.get-comments',":postId")}}'.replace(':postId', postId),

                    success: function (response) {
                        $.each(response.data, function (index, comment) {
                            $('#displayComments_' + postId).append(`
                                 <div class="comment mt-4">
                                    <img src="${comment.user.image}" alt="User Image" class="comment-img"/>
                                    <div class="comment-content">
                                        <span class="username">${comment.user.name}</span>
                                        <p class="comment-text">${comment.comment}</p>
                                    </div>
                                </div>
                                `).show();
                        });
                    }
                })
            });
        });
    </script>
@endpush