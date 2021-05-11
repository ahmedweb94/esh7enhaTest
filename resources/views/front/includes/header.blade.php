<!-- Main Header-->
    <div class="row">
        <div class="col-md-8">
            <div class="offset-md-1 col-md-11">
                <nav class="navbar navbar-expand-lg"><a class="navbar-brand" href="{{url('/')}}"><img
                            src="{{asset('public/assets/front/')}}/assets/imgs/home/logo@2x.png" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#menuToggle" aria-expanded="false"><span
                            class="sr-only">Toggle navigation</span><i
                            class="fas fa-bars"></i></button>
                    <div class="collapse navbar-collapse" id="menuToggle">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="{{\Illuminate\Support\Facades\Request::url()==route('home')?'active':''}}"><a href="{{route('home')}}">{{trans('admin.home')}}</a></li>
                            <li class="{{\Illuminate\Support\Facades\Request::url()==route('products')?'active':''}}"><a href="{{route('products')}}">{{trans('admin.products')}}</a></li>
                            <li class="{{\Illuminate\Support\Facades\Request::url()==route('category')?'active':''}}"><a href="{{route('category')}}">{{trans('admin.categories')}}</a></li>
                            {{--<li><a href="#">Offer</a></li>--}}
                            <li class="{{\Illuminate\Support\Facades\Request::url()==route('about-us')?'active':''}}"><a href="{{route('about-us')}}">{{trans('admin.about_us')}}</a></li>
                            <li class="{{\Illuminate\Support\Facades\Request::url()==route('web.contact')?'active':''}}"><a href="{{route('web.contact')}}">{{trans('admin.contactus')}}</a></li>
                        </ul>
                        <div class="only-xs">
                            <ul class="social-head">
                                <li>
                                    <div class="input-group">
                                        <form action="{{url('products')}}" method="get">
                                    <input class="search-input" name="keyword" type="text" placeholder="{{trans('admin.search')}}">
                                        </form>
                                        <div class="input-group-append">
                                            <span class="input-group-btn"><button class="no-btn opnS"><img
                                                        src="{{asset('public/assets/front/')}}/assets/imgs/home/search.svg"
                                                        alt=""></button></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="notifi"><a href="{{route('cart')}}"><img
                                                src="{{asset('public/assets/front/')}}/assets/imgs/home/cart.svg"
                                                alt=""></a><span id="cart-count">{{\App\Helper\CartCount::count()}}</span></div>
                                </li>
                                <li><a href="{{route('favorite')}}"><img
                                            src="{{asset('public/assets/front/')}}/assets/imgs/home/like.svg"
                                            alt=""></a></li>
                                <li><a href="{{auth()->check()?route('profile'):route('login')}}" ><img
                                            src="{{asset('public/assets/front/')}}/assets/imgs/home/user.svg"
                                            alt="{{auth()->check()?trans('admin.profile'):trans('admin.login')}}"></a></li>
                                @auth
                                    <li>
                                        <form id="logout-form-id1" action="{{route('logout')}}" method="post">
                                            @csrf
                                        </form>
                                        <a href="javascript:;" onclick="event.preventDefault();
                                                     document.getElementById('logout-form-id1').submit();"><img src="{{asset('public/assets/front/')}}/assets/imgs/home/login.svg" alt="{{trans('admin.admin_logout')}}"></a></li>
                                @endauth
                                <li>
                                    <div class="dropdown drop-head">
                                        <button class="dropdown-toggle" data-toggle="dropdown"><img src="{{asset('public/assets/front/')}}/assets/imgs/home/language.svg" alt=""></button>
                                        <div class="dropdown-menu"><a href="{{route('lang','ar')}}" class="dropdown-item">العربية</a><a href="{{route('lang','en')}}" class="dropdown-item">English</a></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                @yield('banner')
            </div>
        </div>
        <div class="col-md-4 padd-0">
            <div class="side-bar-head">
                <ul class="social-head">
                    <li>
                        <button class="no-btn opnS"><img src="{{asset('public/assets/front/')}}/assets/imgs/home/search.svg" alt="">
                        </button>

                            <form action="{{url('products')}}" method="get">
                                <input class="search-input" name="keyword" type="text" placeholder="{{trans('admin.filter')}}">
                                          <button type="submit" class="search-input" style="@if(session('lang')=='en')left: 193px;@else left: -204px; @endif top: 30%;">
                                              <img src="{{asset('public/assets/front/')}}/assets/imgs/home/search.svg"
                                                        alt=""></button>
                            </form>
                    </li>
                    <li>
                        <div class="notifi"><a href="{{route('cart')}}"><img
                                    src="{{asset('public/assets/front/')}}/assets/imgs/home/cart.svg"
                                    alt=""></a><span id="cart-count2">{{\App\Helper\CartCount::count()}}</span></div>
                    </li>
                    <li><a href="{{route('favorite')}}"><img src="{{asset('public/assets/front/')}}/assets/imgs/home/like.svg"
                                         alt=""></a></li>
                    <li><a href="{{auth()->check()?route('profile'):route('login')}}" ><img
                                src="{{asset('public/assets/front/')}}/assets/imgs/home/user.svg"
                                alt="{{auth()->check()?trans('admin.profile'):trans('admin.login')}}"></a></li>
                    @auth
                        <li>
                            <form id="logout-form-id2" action="{{route('logout')}}" method="post">
                                @csrf
                            </form>
                            <a href="javascript:;" onclick="event.preventDefault();
                                                     document.getElementById('logout-form-id2').submit();">
                                <img src="{{asset('public/assets/front/')}}/assets/imgs/home/login.svg" alt="{{trans('admin.admin_logout')}}"></a>
                        </li>
                    @endauth
                    <li>
                    <li>
                        <div class="dropdown drop-head">
                            <button class="dropdown-toggle" data-toggle="dropdown"><img src="{{asset('public/assets/front/')}}/assets/imgs/home/language.svg" alt=""></button>
                            <div class="dropdown-menu">
                                <a href="{{route('lang','ar')}}" class="dropdown-item">العربية</a>
                                <a href="{{route('lang','en')}}" class="dropdown-item">English</a>
                            </div>
                        </div>
                    </li>
                </ul>
                @yield('side')
            </div>
        </div>
    </div>
<!-- End Main Header-->
