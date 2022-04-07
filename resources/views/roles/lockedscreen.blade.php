
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

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
<body class="horizontal-layout horizontal-menu navbar-static 1-column   footer-static bg-full-screen-image  blank-page" data-open="hover" data-menu="horizontal-menu" data-col="1-column">
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- not authorized start -->
            <section class="row flexbox-container">
                <div class="col-xl-7 col-md-8 col-12">
                    <div class="card bg-transparent shadow-none">
                        <div class="card-body text-center bg-transparent">
                            <img src="{{ asset('xlstart-assets/app-assets/images/pages/not-authorized.png') }}" class="img-fluid" alt="not authorized" width="400">
                            <h1 class="my-2 error-title">{{ __('You are not authorized!') }}</h1>
                            <a href="{{ url('/admin') }}" class="btn btn-primary round glow mt-2">{{__('BACK TO HOME')}}</a>
                        </div>
                    </div>
                </div>
            </section>
            <!-- not authorized end -->

        </div>
    </div>
</div>
<!-- END: Content-->


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


</body>
<!-- END: Body-->
</html>
