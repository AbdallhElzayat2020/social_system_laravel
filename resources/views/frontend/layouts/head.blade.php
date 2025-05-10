<head>
    <meta charset="utf-8"/>
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="News Website" name="keywords"/>
    <meta content="News Website" name="description"/>

    <!-- Favicon -->
    <link href="{{asset('assets/frontend/img/favicon.ico')}}" rel="icon"/>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600&display=swap" rel="stylesheet"/>

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet"/>
    <link href="{{asset('assets/frontend/lib/slick/slick.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/frontend/lib/slick/slick-theme.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
          integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous"
          referrerpolicy="no-referrer"/>
    <!-- Template Stylesheet -->
    @stack('css')

    {{-- fileInput Css --}}
    <link rel="stylesheet" href="{{asset('assets/vendor/file-input/css/fileinput.min.css')}}">
    {{-- summernote Plugine --}}
    <link rel="stylesheet" href="{{asset('assets/vendor/summernote/summernote-bs4.min.css')}}">


    <link href="{{asset('assets/frontend/css/style.css')}}" rel="stylesheet"/>
</head>
