<section class="profile custom-padd">
    <h3 class="header2 rose">{{trans('admin.profile')}}</h3>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{\Illuminate\Support\Facades\URL::current()==route('profile')?'active':''}}" href="{{route('profile')}}">
                {{trans('admin.profile')}}</a></li>
        <li class="nav-item"><a class="nav-link {{\Illuminate\Support\Facades\URL::current()==route('password')?'active':''}}" href="{{route('password')}}">{{trans('admin.password')}}</a></li>
        <li class="nav-item"><a class="nav-link {{\Illuminate\Support\Facades\URL::current()==route('favorite')?'active':''}}" href="{{route('favorite')}}">{{trans('admin.favorite')}}</a></li>
        <li class="nav-item"><a class="nav-link {{\Illuminate\Support\Facades\URL::current()==route('track')?'active':''}}"  href="{{route('track')}}">{{trans('admin.track')}}</a></li>
        <li class="nav-item"><a class="nav-link {{\Illuminate\Support\Facades\URL::current()==route('address')?'active':''}}" href="{{route('address')}}" >{{trans('admin.address')}}</a></li>
    </ul>
