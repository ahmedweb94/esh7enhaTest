<html class="no-js">
@include('front.includes.head')
<body class="home-page">
@if(\Illuminate\Support\Facades\URL::current()==url('/'))
    <header class="main-header">
        @else
            <div class="main-parting">
        @endif
        @include('front.includes.header')
        @if(\Illuminate\Support\Facades\URL::current()==url('/'))
    </header>
    @else
    </div>
@endif
@include('front.includes.msg')
<!-- Main Content-->
{{--<main class="main-content">--}}
@yield('content')
{{--</main>--}}
<!-- End Main Content-->
@include('front.includes.footer')
@include('front.includes.js')
</body>
</html>
