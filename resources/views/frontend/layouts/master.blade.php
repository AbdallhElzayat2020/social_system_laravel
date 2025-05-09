<!DOCTYPE html>
<html lang="en">
@include('frontend.layouts.head')
<body>

@include('frontend.layouts.navbar')

<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container">
        <ul class="breadcrumb">
            @section('breadcrumb')
                <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
            @show
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

@yield('content')


@include('frontend.layouts.footer')

<!-- Back to Top -->
<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

@include('frontend.layouts.scripts')
</body>
</html>
