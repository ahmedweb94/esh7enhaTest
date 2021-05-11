<!-- Main footer-->
<footer class="main-footer">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="footer-menu">
                    <li><a href="{{route('about-us')}}">{{trans('admin.about_us')}}</a></li>
                    <li><a href="{{route('web.contact')}}">{{trans('admin.contactus')}}</a></li>
                    {{--<li><a href="#">FAQ</a></li>--}}
                    {{--<li><a href="#">Privacy Policy</a></li>--}}
                    <li><a href="{{route('terms')}}">{{trans('admin.terms')}}</a></li>
                    <li><a href="{{$social->where('index','social_twitter')->first()->value}}" target="_blank"><img src="{{asset('public/assets/front/')}}/assets/imgs/home/twitter.svg" alt=""></a></li>
                    <li><a href="{{$social->where('index','social_instagram')->first()->value}}" target="_blank"><img src="{{asset('public/assets/front/')}}/assets/imgs/home/instagram.svg" alt=""></a></li>
                    <li><a href="{{$social->where('index','social_facebook')->first()->value}}" target="_blank"><img src="{{asset('public/assets/front/')}}/assets/imgs/home/facebook.svg" alt=""></a></li>
                </ul>
            </div>
            <div class="col-12">
                <p> 2020 © Perfectzone</p>
            </div>
        </div>
    </div>
</footer>
<!-- End Main footer-->
