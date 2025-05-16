<!DOCTYPE html>
<html lang="en">

@include('dashboard.layouts.head')

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    @include('dashboard.layouts.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            @include('dashboard.layouts.header')
            <!-- End of Topbar -->

            @yield('content')

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        @include('dashboard.layouts.footer')
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
@include('dashboard.layouts.modal')

<!-- Bootstrap core JavaScript-->
<script src="{{asset('assets/dashboard')}}/vendor/jquery/jquery.min.js"></script>
<script src="{{asset('assets/dashboard')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('assets/dashboard')}}/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('assets/dashboard')}}/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="{{asset('assets/dashboard')}}/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="{{asset('assets/dashboard')}}/js/demo/chart-area-demo.js"></script>
<script src="{{asset('assets/dashboard')}}/js/demo/chart-pie-demo.js"></script>

</body>

</html>