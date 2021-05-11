<!-- Navigation Bar-->
<header id="topnav">

    <div class="topbar-main">
        <div class="container">
            <!-- LOGO -->
            <div class="topbar-left">
                <a href="{{ route('admin.home') }}" class="logo" style="width: 200px;">{{trans('admin.site_name')}}</a>
            </div>
            <!-- End Logo container-->
            <div class="menu-extras">
                <ul class="nav navbar-nav navbar-right pull-right">

                    {{--@can('notifications_management')--}}
                    {{--<li>--}}
                    {{--<div class="notification-box">--}}
                    {{--<ul class="list-inline m-b-0">--}}
                    {{--<li>--}}
                    {{--<a href="javascript:;" class="right-bar-toggle">--}}
                    {{--<i class="zmdi zmdi-notifications-none"></i>--}}


                    {{--<div class="noti-dot"--}}
                    {{--@if(\App\Models\Notification::whereUserId(auth()->id())->whereNull('read_at')->count() > 0)--}}
                    {{--style="display: block;"--}}
                    {{--@else--}}
                    {{--style="display: none;"--}}
                    {{--@endif>--}}
                    {{--<span class="dot"></span>--}}
                    {{--<span class="pulse"></span>--}}
                    {{--</div>--}}

                    {{--</a>--}}

                    {{--</li>--}}
                    {{--</ul>--}}
                    {{--</div>--}}
                    {{--</li>--}}
                    {{--                        <li>--}}
                    {{--                            <!-- Notification -->--}}
                    {{--                            <div class="notification-box">--}}
                    {{--                                <ul class="list-inline m-b-0">--}}
                    {{--                                    <li>--}}
                    {{--                                        <a href="javascript:void(0);" class="right-bar-toggle">--}}
                    {{--                                            <i class="zmdi zmdi-notifications-none"></i>--}}
                    {{--                                        </a>--}}
                    {{--                                        <div class="noti-dot">--}}
                    {{--                                            <span class="dot"></span>--}}
                    {{--                                            <span class="pulse"></span>--}}
                    {{--                                        </div>--}}
                    {{--                                    </li>--}}
                    {{--                                </ul>--}}
                    {{--                            </div>--}}
                    {{--                            <!-- End Notification bar -->--}}
                    {{--                        </li>--}}
                    {{--@endcan--}}
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle waves-effect waves-light profile " data-toggle="dropdown"
                           aria-expanded="true">
                            <img src="{{ request()->root() }}/public/assets/admin/images/saudi-arabia.png"
                                 alt="user-img"
                                 class="img-circle user-img">
                        </a>
                        <ul class="dropdown-menu">
                            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                                {{--{{ app()->getLocale() }} <i class="fa fa-caret-down"></i>--}}
                            {{--</a>--}}
                            @foreach(config('app.locales') as $key=>$value)
                            <li {{session('lang')==$key?'class=active':''}}><a href="{{ url('lang/'.$key) }}"><i style="color: #17fa60" class="fa fa-flag-o"></i> {{$value}} </a></li>
                            @endforeach
                            {{--<li {{session('lang')=='en'?'class=active':''}}><a href="{{ url('lang/en') }}"><i style="color: #ff0e1b" class="fa fa-flag-o"></i> {{trans('admin.en')}} </a></li>--}}
                        </ul>
                    </li>
                    <li class="dropdown user-box">
                        <a href="" class="dropdown-toggle waves-effect waves-light profile " data-toggle="dropdown"
                           aria-expanded="true">
                            <img src="{{ url('storage/app/public/logo.png') }}"
                                 alt="user-img" class="img-circle user-img">
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('admin.profile')}}"><i
                                        class="ti-user m-r-5"></i>@lang('maincp.personal_page')</a></li>
                            <li><a href="{{ route('admin.profile') }}"><i class="ti-settings m-r-5"></i>
                                    @lang('admin.setting')
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="ti-power-off m-r-5"></i>@lang('maincp.log_out')
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="menu-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </div>
            </div>
        </div>
    </div>
    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
          style="display: none;">
        {{ csrf_field() }}
    </form>
    @include('admin.layouts._partials.menu')
</header>
<!-- End Navigation Bar-->
<div class="wrapper">
    <div class="container">
