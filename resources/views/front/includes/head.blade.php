<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="description">
    <meta name="Sard" content="sard">
    <meta name="robots" content="index">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- ******* FavIcon ******* //-->
    <link rel="icon" href="{{asset('public/assets/front/')}}/assets/imgs/favicon.png" type="image/x-icon">
    <!-- ******* CSS File ******* //-->
    @if(session('lang')=='en')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    @else
    <!-- in case of ar--><link rel="stylesheet" href="http://bootstrap.rtlcss.com/docs/4.5/dist/css/rtl/bootstrap.min.css" integrity="sha384-JvExCACAZcHNJEc7156QaHXTnQL3hQBixvj5RV5buE7vgnNEzzskDtx9NQ4p6BJe" crossorigin="anonymous">
    @endif
    <!-- ------//--><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css"><script src="https://momentjs.com/downloads/moment.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('public/assets/front/')}}/assets/css/style.css">
    @if(session('lang')=='ar')
        <!--in case of ar-->
            <link rel="stylesheet" href="{{asset('public/assets/front/')}}/assets/css/styleAr.css">
        @endif
    <style>
        .parsley-errors-list{
            color: #FF001A;
        }
        .notifi span {
            top: -0.3125rem;
        }
        @if(session('lang')=='ar')
        .search-input{
            left: -204px;
        }
        @endif
    </style>
    @yield('css')
</head>
