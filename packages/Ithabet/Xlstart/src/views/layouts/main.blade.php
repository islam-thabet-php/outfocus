<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="{{ (request()->has('ltr')? 'ltr':'rtl') }}">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="author" content="Xative">
    <title>{{ __('Admin Panel') }}</title>
    <link rel="apple-touch-icon" href="{{ asset('xlstart-assets/') }}/app-assets/images/ico/apple-icon-120.html">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('xlstart-assets/') }}/app-assets/images/ico/favicon.ico">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @if(session()->get('locale')=='ar')
        <!-- BEGIN: Vendor CSS-->
            <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/app-assets/vendors/css/vendors-rtl.min.css">
            <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/app-assets/vendors/css/charts/apexcharts.css">
            <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/app-assets/vendors/css/extensions/dragula.min.css">
            <!-- END: Vendor CSS-->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;500&display=swap" rel="stylesheet">
            <!-- BEGIN: Theme CSS-->
            <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/app-assets/css-rtl/bootstrap.min.css">
            <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/app-assets/css-rtl/bootstrap-extended.min.css">
            <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/app-assets/css-rtl/colors.min.css">
            <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/app-assets/css-rtl/components.min.css">
            <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/app-assets/css-rtl/themes/dark-layout.min.css">
            <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/app-assets/css-rtl/themes/semi-dark-layout.min.css">
            <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/app-assets/css-rtl/custom-rtl.min.css">
            <!-- END: Theme CSS-->

            <!-- BEGIN: Page CSS-->
            <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/app-assets/css-rtl/core/menu/menu-types/horizontal-menu.min.css">
            <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/app-assets/css-rtl/pages/widgets.min.css">
            <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/app-assets/css/plugins/forms/validation/form-validation.css">
            <!-- END: Page CSS-->

            <!-- BEGIN: Custom CSS-->
            <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/assets/css/style-rtl.css">
            <!-- END: Custom CSS-->


    @else

        <!-- BEGIN: Vendor CSS-->
            <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/app-assets/vendors/css/vendors.min.css">
            <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/app-assets/vendors/css/charts/apexcharts.css">
            <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/app-assets/vendors/css/extensions/swiper.min.css">
            <!-- END: Vendor CSS-->

            <!-- BEGIN: Theme CSS-->
            <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/app-assets/css/bootstrap.min.css">
            <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/app-assets/css/bootstrap-extended.min.css">
            <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/app-assets/css/colors.min.css">
            <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/app-assets/css/components.min.css">
            <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/app-assets/css/themes/dark-layout.min.css">
            <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/app-assets/css/themes/semi-dark-layout.min.css">
            <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/app-assets/css/custom.min.css">

            <!-- END: Theme CSS-->

            <!-- BEGIN: Page CSS-->
            <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/app-assets/css/core/menu/menu-types/horizontal-menu.min.css">
            <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/app-assets/css/plugins/forms/validation/form-validation.css">
            <!-- END: Page CSS-->

            <!-- BEGIN: Custom CSS-->
            <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/assets/css/style.css">
            <!-- END: Custom CSS-->

        @endif
    <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/app-assets/vendors/css/extensions/toastr.css">


    <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets/') }}/app-assets/css/plugins/extensions/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets') }}/app-assets/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets') }}/app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('xlstart-assets') }}/app-assets/vendors/css/pickers/daterange/daterangepicker.css">

    @stack('styles')
</head>
<!-- END: Head-->

<!-- BEGIN: Body
for vertical menu sidebar
use this class instead of -- horizontal-layout horizontal-menu
                          -> vertical-layout vertical-menu-modern
                          and remove -h form includes.
-->
<body class="horizontal-layout horizontal-menu navbar-static 2-columns " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

@include('xlstart::layouts.partials.h-navbar')
@include('xlstart::layouts.partials.h-sidebar')



<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    @yield('content')
</div>
<!-- END: Content-->




<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light">
    <p class="clearfix mb-0"><span class="float-left d-inline-block">2021 &copy; Ovision</span><span class="float-right d-sm-inline-block d-none">Crafted with<i class="bx bxs-heart pink mx-50 font-small-3"></i>by<a class="text-uppercase" href="https://ovisioneg.com" target="_blank">Ovision</a></span>
        <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="bx bx-up-arrow-alt"></i></button>
    </p>
</footer>
<!-- END: Footer-->

<script>
    APP_URL = '{{ env('APP_URL') }}';
</script>
<!-- BEGIN: Vendor JS-->
<script src="{{ asset('xlstart-assets/') }}/app-assets/vendors/js/vendors.min.js"></script>
<script src="{{ asset('xlstart-assets/') }}/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.min.js"></script>
<script src="{{ asset('xlstart-assets/') }}/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.min.js"></script>
<script src="{{ asset('xlstart-assets/') }}/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('xlstart-assets/') }}/app-assets/vendors/js/charts/apexcharts.min.js"></script>
<script src="{{ asset('xlstart-assets/') }}/app-assets/vendors/js/extensions/swiper.min.js"></script>
<!-- END: Page Vendor JS-->
<script src="{{ asset('xlstart-assets/') }}/app-assets/vendors/js/extensions/toastr.min.js"></script>
<script src="{{ asset('xlstart-assets/') }}/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
<script src="{{ asset('xlstart-assets/') }}/app-assets/vendors/js/ui/jquery.sticky.js"></script>
<!-- BEGIN: Theme JS-->
<script src="{{ asset('xlstart-assets/') }}/app-assets/js/scripts/configs/vertical-menu-light.min.js"></script>
<script src="{{ asset('xlstart-assets/') }}/app-assets/js/core/app-menu.min.js"></script>
<script src="{{ asset('xlstart-assets/') }}/app-assets/js/core/app.min.js"></script>
<script src="{{ asset('xlstart-assets/') }}/app-assets/js/scripts/components.min.js"></script>
<script src="{{ asset('xlstart-assets/') }}/app-assets/js/scripts/footer.min.js"></script>
<script src="{{ asset('xlstart-assets/') }}/app-assets/js/scripts/customizer.min.js"></script>
<script src="{{ asset('xlstart-assets/') }}/app-assets/js/scripts/modal/components-modal.min.js"></script>


<!-- END: Theme JS-->
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@if(session()->has('status'))
    <script type="text/javascript">
        $(function(){
            toastr.{{session()->get('status')}}("{{ session()->get('message') }}",
                "{{ __('Success !') }}",{
                    positionClass: "toast-top-left",
                    closeButton: !0,
                    tapToDismiss: !1,
                    progressBar: !0,
                    rtl: 'rtl'
                });
        })
    </script>
@endif

<script src="{{ asset('xlstart-assets/') }}/app-assets/vendors/js/file-uploaders/dropzone.min.js"></script>
<script src="{{ asset('xlstart-assets/') }}/app-assets/vendors/js/ui/prism.min.js"></script>
<script src="{{ asset('xlstart-assets') }}/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
<script src="{{ asset('xlstart-assets') }}/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
<script src="{{ asset('xlstart-assets') }}/app-assets/vendors/js/pickers/pickadate/picker.time.js"></script>
<script src="{{ asset('xlstart-assets') }}/app-assets/vendors/js/pickers/pickadate/legacy.js"></script>
<script src="{{ asset('xlstart-assets') }}/app-assets/vendors/js/extensions/moment.min.js"></script>
<script src="{{ asset('xlstart-assets') }}/app-assets/vendors/js/pickers/daterange/daterangepicker.js"></script>
<script src="{{ asset('xlstart-assets') }}/app-assets/vendors/js/forms/select/select2.full.min.js"></script>

@stack('scripts')

<script>
    $('.select2').select2();
</script>
</body>
<!-- END: Body-->
</html>
