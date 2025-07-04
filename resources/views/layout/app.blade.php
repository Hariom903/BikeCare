<!doctype html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title> </title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />

    <!-- [Favicon] icon -->
    <link rel="icon" href="../assets/images/favicon.svg" type="image/x-icon" />
    <!-- [Font] Family -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}" />
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>


  <!-- Font Awesome CDN (Free) -->
  @yield('link')

    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}" />
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link" />
    <link rel="stylesheet" href="{{ asset('assets/css/mystyle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style-preset.css') }}" />

</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ Sidebar Menu ] start -->
   @include('navbar')
    <!-- [ Sidebar Menu ] end -->

    @include('header')


    <!-- [ Main Content ] start -->
    <div class="pc-container">

@yield('main')

    </div>
    <!-- [ Main Content ] end -->



    @include('footer');

    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <!-- Required Js -->
    <script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>
</body>
<!-- [Body] end -->

</html>
