<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <!-- App Favicon -->
    <link rel="shortcut icon" href="{{ request()->root() }}/admin/assets/images/favicon.ico">

    <!-- App title -->
    <title>{{trans('admin.site_name')}}</title>

    <!-- App CSS -->


    <link href="{{ request()->root() }}/public/assets/admin/css-{{ config('app.locale') }}/bootstrap.min.css"
          rel="stylesheet"
          type="text/css"/>
    <link href="{{ request()->root() }}/public/assets/admin/css-{{ config('app.locale') }}/core.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{ request()->root() }}/public/assets/admin/css-{{ config('app.locale') }}/components.css"
          rel="stylesheet"
          type="text/css"/>
    <link href="{{ request()->root() }}/public/assets/admin/css-{{ config('app.locale') }}/icons.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{ request()->root() }}/public/assets/admin/css-{{ config('app.locale') }}/pages.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{ request()->root() }}/public/assets/admin/css-{{ config('app.locale') }}/menu.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{ request()->root() }}/public/assets/admin/css-{{ config('app.locale') }}/responsive.css"
          rel="stylesheet"
          type="text/css"/>
    <link href="{{ request()->root() }}/public/assets/admin/css-{{ config('app.locale') }}/css/index.css"
          rel="stylesheet"
          type="text/css"/>


    <!--Morris Chart CSS -->
    <link href="https://fonts.googleapis.com/css?family=Tajawal" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <style>
        input,
        input::-webkit-input-placeholder {
            font-size: 11px;
            line-height: 3;
        }
    </style>

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script src="assets/js/modernizr.min.js"></script>
</head>
<body>


<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page" style="margin:  3% auto">
    @include('admin.layouts._partials.msg')
    <div class="text-center">
        <a href="{{ route('admin.login') }}" class="logo">
            <span>{{trans('admin.site_name')}}</span>
        </a>
    </div>
    @yield('content')
</div>


<!-- end wrapper page -->


<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="{{ request()->root() }}/public/assets/admin/js/jquery.min.js"></script>
<script src="{{ request()->root() }}/public/assets/admin/js/bootstrap-rtl.min.js"></script>
<script src="{{ request()->root() }}/public/assets/admin/js/detect.js"></script>
<script src="{{ request()->root() }}/public/assets/admin/js/fastclick.js"></script>
<script src="{{ request()->root() }}/public/assets/admin/js/jquery.slimscroll.js"></script>
<script src="{{ request()->root() }}/public/assets/admin/js/jquery.blockUI.js"></script>
<script src="{{ request()->root() }}/public/assets/admin/js/waves.js"></script>
<script src="{{ request()->root() }}/public/assets/admin/js/wow.min.js"></script>
<script src="{{ request()->root() }}/public/assets/admin/js/jquery.nicescroll.js"></script>
<script src="{{ request()->root() }}/public/assets/admin/js/jquery.scrollTo.min.js"></script>
<script src="{{ request()->root() }}/public/assets/admin/plugins/toastr/toastr.min.js"></script>
<script type="text/javascript"
        src="{{ request()->root() }}/public/assets/admin/plugins/parsleyjs/dist/parsley.min.js"></script>
<!-- App js -->
<script src="{{ request()->root() }}/public/assets/admin/js/jquery.core.js"></script>
<script src="{{ request()->root() }}/public/assets/admin/js/jquery.app.js"></script>
<script>

    // $('form').parsley().validate();
    @if(session()->has('success'))
    setTimeout(function () {
        showMessage('{{ session()->get('success') }}');
    }, 1000);
    <?php session()->forget('success');?>
    @endif
    @if(session()->has('error'))
        console.log('{{session()->get('error')}}');
    setTimeout(function () {
        showErrors('{{ session()->get('error') }}');
    }, 1000);
    <?php session()->forget('error');?>
    @endif
    function showMessage(message, type = "success") {
        var shortCutFunction = type;
        var msg = message;
        var title = "";
        toastr.options = {
            positionClass: 'toast-top-center',
            onclick: null,
            // showMethod: 'slideDown',
            // hideMethod: "slideUp",
        };
        var $toast = toastr[shortCutFunction](msg, title);
        // Wire up an event handler to a button in the toast, if it exists
        $toastlast = $toast;
    }
    @if(session()->has('errorsValidation'))
    setTimeout(function () {
        showErrors('{{ session()->get('errorsValidation') }}');
    }, 1000);
    @endif
    function showErrors(message) {
        var shortCutFunction = 'error';
        var msg = message;
        var title = "";
        toastr.options = {
            positionClass: 'toast-top-center',
            onclick: null,
            // showMethod: 'slideDown',
            // hideMethod: "slideUp",
        };
        var $toast = toastr[shortCutFunction](msg, title);
        // Wire up an event handler to a button in the toast, if it exists
        $toastlast = $toast;
    }
</script>
</body>
</html>
