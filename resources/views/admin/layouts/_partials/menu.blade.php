<div class="navbar-custom">
    <div class="container">
        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu" style=" font-size: 14px;">
                {{--<li>--}}
                    {{--<a href="{{ route('admin.home') }}">--}}
                        {{--<i class="zmdi zmdi-view-dashboard"></i>--}}
                        {{--<span> @lang('admin.home') </span>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--@canany(['add admin','edit admin','show admin','delete admin'])--}}
                    {{--<li class="has-submenu">--}}
                        {{--<a href="{{route('admin.index')}}"><i--}}
                                {{--class="zmdi zmdi-account"></i><span>{{trans('admin.admins')}}</span></a>--}}
                    {{--</li>--}}
                {{--@endcan--}}
                {{--@canany(['add role','edit role','show role','delete role'])--}}
                    {{--<li class="has-submenu">--}}
                        {{--<a href="{{route('role.index')}}"><i--}}
                                {{--class="zmdi zmdi-layers"></i><span>{{trans('admin.roles_and_permission')}}</span></a>--}}
                    {{--</li>--}}
                {{--@endcan--}}
                {{--@canany(['add driver','edit driver','show driver','delete driver','show users','edit users'])--}}
                    {{--<li class="has-submenu">--}}
                        {{--<a href="javascript:;"><i class="zmdi zmdi-layers"></i><span>{{trans('admin.users')}}</span></a>--}}
                        {{--<ul class="submenu">--}}
                            {{--@canany(['show users','edit users'])--}}
                                {{--<li><a href="{{route('user.index')}}">{{trans('admin.users')}}</a></li>--}}
                            {{--@endcan--}}
                            {{--@canany(['add driver','edit driver','show driver','delete driver'])--}}
                                {{--<li><a href="{{route('driver.index')}}">{{trans('admin.drivers')}}</a></li>--}}
                            {{--@endcan--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                {{--@endcan--}}
                {{--@canany(['add category','edit category','show category','delete category'])--}}
                    {{--<li class="has-submenu">--}}
                        {{--<a href="{{ route('category.index') }}"><i--}}
                                {{--class="zmdi zmdi-layers"></i><span> {{trans('admin.category')}} </span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                {{--@endcan--}}
                {{--@canany(['add product','edit product','show product','delete product'])--}}
                    {{--<li class="has-submenu">--}}
                        {{--<a href="javascript:;"><i--}}
                                {{--class="zmdi zmdi-layers"></i><span>{{trans('admin.product')}}</span></a>--}}
                        {{--<ul class="submenu">--}}
                            {{--<li><a href="{{route('product.index')}}">{{trans('admin.show_products')}}</a></li>--}}
                            {{--<li><a href="{{route('product.create')}}">{{trans('admin.add')}}</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                {{--@endcan--}}
                {{--@can('edit static pages')--}}
                    {{--<li class="has-submenu">--}}
                        {{--<a href="javascript:;"><i--}}
                                {{--class="zmdi zmdi-layers"></i><span>{{trans('admin.content_management')}}</span></a>--}}
                        {{--<ul class="submenu">--}}
                            {{--<li><a href="{{route('page.index')}}">{{trans('admin.pages')}}</a></li>--}}
                            {{--<li><a href="{{route('social.index')}}">{{trans('admin.social_pages')}}</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                {{--@endcan--}}
                {{--@can('edit setting')--}}
                    {{--<li class="has-submenu">--}}
                        {{--<a href="{{ route('setting.index') }}"><i--}}
                                {{--class="zmdi zmdi-layers"></i><span> {{trans('admin.setting')}} </span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                {{--@endcan--}}
                {{--@canany(['add city','edit city','show city','delete city','add region','delete region','show region','edit region'])--}}
                    {{--<li class="has-submenu">--}}
                        {{--<a href="javascript:;"><i--}}
                                {{--class="zmdi zmdi-layers"></i><span>{{trans('admin.cities_and_regions')}}</span></a>--}}
                        {{--<ul class="submenu">--}}
                            {{--@canany(['add city','edit city','show city','delete city'])--}}
                                {{--<li><a href="{{route('region.index')}}">{{trans('admin.regions')}}</a></li>--}}
                            {{--@endcan--}}
                            {{--@canany(['add region','delete region','show region','edit region'])--}}
                                {{--<li><a href="{{route('city.index')}}">{{trans('admin.cities')}}</a></li>--}}
                            {{--@endcan--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                {{--@endcan--}}
                {{--@canany(['add order','show order'])--}}
                {{--<li class="has-submenu">--}}
                    {{--<a href="javascript:;"><i--}}
                            {{--class="zmdi zmdi-layers"></i><span> {{trans('admin.orders')}} </span>--}}
                    {{--</a>--}}
                    {{--<ul class="submenu">--}}
                        {{--<li><a href="{{route('order.index')}}">{{trans('admin.orders')}}</a></li>--}}
                        {{--<li>--}}
                            {{--<a href="{{route('order.index')}}?status={{\App\Helper\OrderStatus::newOrder}}">{{trans('admin.new_orders')}}</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="{{route('order.index')}}?status={{\App\Helper\OrderStatus::accepted}}">{{trans('admin.accepted_orders')}}</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="{{route('order.index')}}?status={{\App\Helper\OrderStatus::delivering}}">{{trans('admin.delivering_orders')}}</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="{{route('order.index')}}?status={{\App\Helper\OrderStatus::admin_cancel}}">{{trans('admin.admin_cancel_orders')}}</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="{{route('order.index')}}?status={{\App\Helper\OrderStatus::user_cancel}}">{{trans('admin.user_cancel_orders')}}</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="{{route('order.index')}}?status={{\App\Helper\OrderStatus::delivered}}">{{trans('admin.finished_orders')}}</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--@endcan--}}
                {{--@can('show contact us')--}}
                {{--<li class="has-submenu">--}}
                    {{--<a href="{{ route('contact') }}"><i--}}
                            {{--class="zmdi zmdi-layers"></i><span> {{trans('admin.contactus')}} </span>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--@endcan--}}
            </ul>
            <!-- End navigation menu  -->
        </div>
    </div>
</div>
