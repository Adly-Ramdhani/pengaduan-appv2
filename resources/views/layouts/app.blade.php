<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pengaduan Masyarakat</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('Modernize/src/assets/images/logos/favicon.png') }}"/>
  <link rel="stylesheet" href="{{ asset('Modernize/src/assets/css/styles.min.css') }}"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
        @include('layouts.sidebar')
        
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      @include('layouts.navbar')
      <!--  Header End -->
      <div class="container-fluid">
        <!--  Row 1 -->
        @yield('content')

        @include('layouts.footer')
      </div>
    </div>
  </div>
  <script src="{{ asset('Modernize/src/assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('Modernize/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('Modernize/src/assets/js/sidebarmenu.js') }}"></script>
  <script src="{{ asset('Modernize/src/assets/js/app.min.js') }}"></script>
  <script src="{{ asset('Modernize/src/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
  <script src="{{ asset('Modernize/src/assets/libs/simplebar/dist/simplebar.js') }}"></script>
  <script src="{{ asset('Modernize/src/assets/js/dashboard.js') }}"></script>

  @if(session('success'))
<script>
    document.addEventListener("DOMContentLoaded", function () {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    });
</script>
@endif
</body>

</html>