<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ $title ?? Auth::user()->user_type.' Dashboard' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="CA2 Carbon Assets" name="description" />
    <meta content="CA2 Carbon Assets" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.png') }}">

    <!-- jquery.vectormap css -->
    <link href="{{ asset('admin/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('admin/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://nacomns.fra1.digitaloceanspaces.com/portal/staff/assets/vendor/toastr/css/toastr.min.css"/>
    <script src="https://kit.fontawesome.com/a5a1968140.js" crossorigin="anonymous"></script>
    @livewireStyles()
    @stack('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript" src="https://sandbox.web.squarecdn.com/v1/square.js"></script>
</head>

<body data-layout="detached" data-topbar="colored" @if(Auth::user()->dark_mode==true) data-bs-theme="dark"  @endif>
    <div id="preloader">
        <div id="status">
            <div class="spinner-chase">
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
            </div>
        </div>
    </div>
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <div class="container-fluid">
        <!-- Begin page -->
        <div id="layout-wrapper">

            @include('livewire.website-admin.includes.header')
            <!-- ========== Left Sidebar Start ========== -->
            @include('layouts.partials.client-navbar')
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                {{ $slot }}
                <!-- End Page-content -->

                @include('livewire.website-admin.includes.footer')
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

    </div>
    <!-- end container-fluid -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <!-- JAVASCRIPT -->
    <script src="{{ asset('admin/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- apexcharts -->
    {{-- <script src="{{ asset('admin/assets/libs/apexcharts/apexcharts.min.js') }}"></script> --}}

    <!-- jquery.vectormap map -->
    <script src="{{ asset('admin/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}">
    </script>
    <script src="{{ asset('admin/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js') }}">
    </script>

    {{-- <script src="{{ asset('admin/assets/js/pages/dashboard.init.js') }}"></script> --}}

    <script src="{{ asset('admin/assets/js/app.js') }}"></script>



    @livewireScripts()
    <script src="https://nacomns.fra1.digitaloceanspaces.com/portal/staff/assets/vendor/toastr/js/toastr.min.js"></script>
    <script src="https://nacomns.fra1.digitaloceanspaces.com/portal/staff/assets/js/plugins-init/toastr-init.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/square-payment-form@5.0.0/dist/square-payment-form.js"></script> --}}

    <x-confirm-alert/>
    <x-toast-notification/>
    @stack('scripts')
    <script>
        function numericInputs(event) {
            var input = event.target;
            var inputValue = input.value;
            var regex = /^[0-9]*$/; // This regex only allows digits from 0 to 9.

            if (!regex.test(inputValue)) {
                // If the input doesn't match the regex, clear the input field.
                input.value = inputValue.replace(/[^0-9]/g, '');
            }
        }

        function alphabetInputs(event) {
            var alfInput = event.target;
            var alfInputValue = alfInput.value;
            var regex = /^[a-z,A-Z]*$/; // This regex only allows digits from 0 to 9.

            if (!regex.test(alfInputValue)) {
                // If the alfInput doesn't match the regex, clear the alfInput field.
                alfInput.value = alfInputValue.replace(/[^a-z,A-Z]/g, '');
            }
        }
    </script>
</body>

</html>
