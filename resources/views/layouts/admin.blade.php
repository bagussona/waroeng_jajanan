<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<meta name="description" content="Waroeng Jajanan">

    @yield('title')

	<link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/simple-line-icons.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/vendors/pace-progress/css/pace.min.css') }}" rel="stylesheet">

    <script src="https://kit.fontawesome.com/ba382d8b46.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script crossorigin src="https://unpkg.com/react@17/umd/react.production.min.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@17/umd/react-dom.production.min.js"></script>
    <script src="{{ asset('js/react-component.js') }}"></script>
    <script src="{{ asset('js/invoice.js') }}"></script>

</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">

    @include('layouts.module.header')

    <div class="app-body" id="fws">
        <div class="sidebar">

            @include('layouts.module.sidebar')

            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>

        @yield('content')

    </div>

    <footer class="app-footer">
        <div>
            <a href="{{ route('home') }}">Waroeng Jajanan</a>
            <span>&copy; 2021</span>
        </div>
        <div class="ml-auto">
            <span>Powered by</span>
            <a href="https://coreui.io">coreui.io</a>
        </div>
    </footer>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>
    <script src="{{ asset('assets/js/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/coreui.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom-tooltips.min.js') }}"></script>
    @yield('js')
</body>
</html>
