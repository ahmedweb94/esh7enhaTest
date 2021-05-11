<!-- Right Sidebar -->
{{--<div class="side-bar right-bar">--}}
    {{--<a href="javascript:void(0);" class="right-bar-toggle">--}}
        {{--<i class="zmdi zmdi-close-circle-o"></i>--}}
    {{--</a>--}}
    {{--<h4 class="">الإشعارات</h4>--}}
    {{--<div class="notification-list nicescroll">--}}
        {{--<ul class="list-group list-no-border user-list">--}}
            {{--@foreach(\App\Models\Notification::latest()->whereUserId(auth()->id())->whereNull('read_at')->limit(100)->get() as $notification )--}}
                {{--<li class="list-group-item {{ $notification['read_at'] == null ? '' : "" }}">--}}
                    {{--<a href="{{  generateNotificationUrlsForDashboard($notification) }}" class="user-list-item ">--}}
                        {{--<div class="avatar">--}}
                            {{--<img src="assets/images/users/avatar-2.jpg" alt="">--}}
                        {{--</div>--}}
                        {{--<div class="user-desc">--}}
                            {{--<span class="name">{{ $notification['title'] }}</span>--}}
                            {{--<span class="desc">{{ $notification['body'] }}</span>--}}
                            {{--<span class="time">{{ $notification->created_at != null ? $notification->created_at->diffForHumans() : "" }}</span>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</li>--}}
            {{--@endforeach--}}
        {{--</ul>--}}
    {{--</div>--}}
{{--</div>--}}
<!-- /Right-bar -->
