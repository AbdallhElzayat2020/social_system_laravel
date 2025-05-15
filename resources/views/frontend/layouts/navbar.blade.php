<!-- Top Bar Start -->
<div class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="tb-contact">
                    <p><i class="fas fa-envelope"></i>{{@$getSetting->site_email}}</p>
                    <p><i class="fas fa-phone-alt"></i>{{@$getSetting->site_phone}}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="tb-menu">
                    @guest
                        <a href="{{ route('register') }}"><i class="fas fa-user-plus"></i> Register</a>
                        <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login</a>
                    @endguest

                    {{-- logout --}}
                    @auth
                        <div class="d-flex justify-content-end">
                            <form action="{{ route('logout') }}" id="formLogout" method="post">
                                @csrf
                                <a onclick="event.preventDefault(); document.getElementById('formLogout').submit();" href="javascript:void(0);">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                            </form>
                            <a href="{{ route('frontend.dashboard.profile') }}"><i class="fas fa-user"></i> {{auth()->user()->name}}</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Top Bar Start -->

<!-- Brand Start -->
<div class="brand">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4">
                <div class="b-logo">
                    <a href="">
                        <img src="{{asset('assets/frontend')}}{{$getSetting->site_logo}}" alt="{{$getSetting->site_name}}"/>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-4">
                <div class="b-ads">

                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <form action="{{ route('frontend.search') }}" method="post">
                    @csrf
                    <div class="b-search">
                        <input type="text" name="search" placeholder="Search"/>
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- Brand End -->

<!-- Nav Bar Start -->
<div class="nav-bar">
    <div class="container">
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <a href="#" class="navbar-brand">MENU</a>
            <button
                    type="button"
                    class="navbar-toggler"
                    data-toggle="collapse"
                    data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav mr-auto">
                    <a href="{{ route('frontend.index') }}" title="home" class="nav-item nav-link active">Home</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Categories</a>
                        <div class="dropdown-menu">
                            @foreach($categories as $category)
                                <a href="{{ route('frontend.category.posts',$category->slug) }}" class="dropdown-item"
                                   title="{{$category->name}}">{{$category->name}}</a>
                            @endforeach
                        </div>
                    </div>
                    <a href="{{ route('frontend.contact.index') }}" class="nav-item nav-link">Contact Us</a>

                    <a href="{{ route('frontend.dashboard.profile') }}" class="nav-item nav-link">Dashboard</a>

                </div>
                <div class="social ml-auto">
                    <!-- Notification Dropdown -->
                    <a href="#" class="nav-link dropdown-toggle" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        <span class="badge badge-danger">{{ auth()->check() ? auth()->user()->unreadNotifications()->count() : 0 }}</span>
                    </a>

                    @if(auth()->check())
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown" style="width: 300px;">
                            <h6 class="dropdown-header">Notifications</h6>

                            @forelse(auth()->user()->unreadNotifications->take(4) as $notification)
                                <div class="dropdown-item d-flex justify-content-between align-items-center border-bottom py-2">
                                    <div>
                                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                        <span class="d-block">New Comment: {{substr($notification->data['post_title'],0,7 )}}...</span>
                                        <div class="mt-2 align-items-end">
                                            {{-- <a href="{{$notification->data['link']}}?notify" class="btn btn-sm btn-primary text-white">--}}
                                            <a href="{{ route('frontend.dashboard.notifications.redirect', $notification->id) }}"
                                               class="btn btn-sm btn-primary">
                                                <i style="font-size: 17px" class="fa fa-eye"></i>
                                            </a>
                                            <form action="{{ route('frontend.dashboard.notifications.destroy') }}" method="POST"
                                                  style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete Notification">
                                                    <input type="hidden" name="notification_id" value="{{ $notification->id }}">
                                                    <i style="font-size: 17px" class="fa fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="dropdown-item text-center">No notifications</div>
                            @endforelse

                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <div class="dropdown-item text-center border-top">
                                    <form action="{{ route('frontend.dashboard.notifications.markAllAsRead') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Mark All as Read</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown" style="width: 300px;">
                            <div class="dropdown-item text-center">Please log in to see notifications</div>
                        </div>
                    @endif


                    <a rel="nofollow" target="_blank" href="{{$getSetting->twitter_link}}" title="twitter"><i class="fab fa-twitter"></i></a>
                    <a rel="nofollow" target="_blank" href="{{$getSetting->facebook_link}}" title="facebook"><i class="fab fa-facebook-f"></i></a>
                    <a rel="nofollow" target="_blank" href="{{$getSetting->linkedin_link}}" title="linkedin"><i class="fab fa-linkedin-in"></i></a>
                    <a rel="nofollow" target="_blank" href="{{$getSetting->instagram_link}}" title="instagram"><i class="fab fa-instagram"></i></a>
                    <a rel="nofollow" target="_blank" href="{{$getSetting->youtube_link}}" title="youtube"><i class="fab fa-youtube"></i></a>

                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Nav Bar End -->
