<!-- Bootstrap core JavaScript-->
<script src="{{asset('assets/dashboard/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('assets/dashboard/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('assets/dashboard/js/sb-admin-2.min.js')}}"></script>

<!-- Page level plugins -->
<script src="{{asset('assets/dashboard/vendor/chart.js/Chart.min.js')}}"></script>
<!-- Page level custom scripts -->

{{-- fileInput js --}}
<script src="{{asset('assets/vendor/file-input/js/fileinput.min.js')}}"></script>
<script src="{{asset('assets/vendor/file-input/themes/fa5/theme.min.js')}}"></script>

{{-- summernote Plugine --}}
<script src="{{asset('assets/vendor/summernote/summernote-bs4.min.js')}}"></script>

<script src="{{asset('assets/dashboard/js/demo/chart-area-demo.js')}}"></script>
<script src="{{asset('assets/dashboard/js/demo/chart-pie-demo.js')}}"></script>

@stack('js')

@livewireScripts
