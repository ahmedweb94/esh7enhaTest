<!--banner-->
<div class="banner">
    <div class="banner-txt">
        <h3 class="green header">{{trans('admin.rose_title')}}</h3>
        <p>{{trans('admin.rose_desc')}}</p>
        <div class="banner-btns">
            {{--<button class="btn-rose">Home</button>--}}
            {{--<button class="btn-border">Home</button>--}}
        </div>
    </div>
    <div class="carousel-wrap">
        <div class="carousel slide" id="banner-caro" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="banner-img"><img src="{{asset('public/assets/front/')}}/assets/imgs/home/banner-img@2x.png" alt=""></div>
                </div>
                <div class="carousel-item">
                    <div class="banner-img"><img src="{{asset('public/assets/front/')}}/assets/imgs/home/banner-img@2x.png" alt=""></div>
                </div>
                <div class="carousel-item">
                    <div class="banner-img"><img src="{{asset('public/assets/front/')}}/assets/imgs/home/banner-img@2x.png" alt=""></div>
                </div>
            </div>
            <div class="carousel-indicators">
                <li class="active" data-target="#banner-caro" data-slide-to="0"></li>
                <li data-target="#banner-caro" data-slide-to="1"></li>
                <li data-target="#banner-caro" data-slide-to="2"></li>
            </div>
        </div>
    </div>
</div>
