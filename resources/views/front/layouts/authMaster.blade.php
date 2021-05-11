<html class="no-js">
@include('front.includes.head')
<body class="home-page">
@include('front.includes.msg')
<!-- Main Content-->
{{--<main class="main-content">--}}
    @yield('content')
{{--</main>--}}
<!-- End Main Content-->
@include('front.includes.js')
</body>
</html>
