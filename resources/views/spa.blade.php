@php
$config = [
    'appName' => config('app.name'),
    'appVersion' => config('app.version'),
    'locale' => $locale = app()->getLocale(),
    'locales' => config('app.locales'),
];
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap">

<link rel="stylesheet" href="{{ asset('adminlte/colors.css') }}">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ asset('adminlte/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.css') }}">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>{{ config('app.name') }}</title>
  <script type="text/javascript">
    window.Laravel = {
      jsPermissions: {!! auth()->check()?auth()->user()->jsPermissions():null !!}
    }
  </script>
{{--  <link rel="stylesheet" href="{{ mix('dist/css/app.css') }}">--}}
</head>
<body class="hold-transition sidebar-mini">


  <div id="app"></div>


  {{-- Global configuration object --}}
  <script>
    window.config = @json($config);
  </script>

  {{-- Load the application scripts --}}
  <!-- jQuery -->
  <script src="{{ asset('adminlte/jquery/jquery.min.js')  }}"></script>
{{--  <!-- Bootstrap 4 -->--}}
{{--  <script src="{{ asset('adminlte/bootstrap/js/bootstrap.bundle.min.js')  }}"></script>--}}
{{--  <!-- AdminLTE App -->--}}
  <script src="{{ asset('adminlte/js/adminlte.min.js')  }}"></script>
{{--  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>--}}
{{--  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>--}}
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="{{ asset('adminlte/sweetalert2/sweetalert2.min.js') }}"></script>
{{--  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>--}}
  <script src="{{ mix('dist/js/app.js') }}"></script>
  <script>
    let Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
  </script>
</body>
</html>
