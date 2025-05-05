<!DOCTYPE html>
<html lang="en">
@include('frontend.layouts.head')
<body>

@include('frontend.layouts.navbar')

@yield('content')


@include('frontend.layouts.footer')

<!-- Back to Top -->
<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

@include('frontend.layouts.scripts')
</body>
</html>
