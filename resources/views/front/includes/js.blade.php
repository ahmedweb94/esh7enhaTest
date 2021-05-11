<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js"></script>
{{--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBr8fHyX4CFO0PMq4dxJlhPH8RrjXfyN8&amp;callback=initMap"></script>--}}

<script src="{{ asset('') }}/public/assets/admin/plugins/toastr/toastr.min.js"></script>
<script type="text/javascript" src="{{asset('')}}/public/assets/admin/plugins/parsleyjs/dist/parsley.min.js"></script>
<script src="{{asset('public/assets/front/')}}/assets/js/functions.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function () {
        $('form').parsley();
    });
    $(document).ready(function () {
        if ($('#timer').is(":visible")) {
            var timer2 = $('#timer').html();
            var interval = setInterval(function () {
                var timer = timer2.split(':');
                //by parsing integer, I avoid all extra string processing
                var minutes = parseInt(timer[0], 10);
                var seconds = parseInt(timer[1], 10);
                --seconds;
                minutes = (seconds < 0) ? --minutes : minutes;
                seconds = (seconds < 0) ? 59 : seconds;
                seconds = (seconds < 10) ? '0' + seconds : seconds;
                //minutes = (minutes < 10) ?  minutes : minutes;
                $('#timer').html(minutes + ':' + seconds);
                if (minutes < 0) clearInterval(interval);
                //check if both minutes and seconds are 0
                if ((seconds <= 0) && (minutes <= 0)) clearInterval(interval);
                timer2 = minutes + ':' + seconds;
                if ((seconds == 0) && (minutes == 0)) {
                    $('#sendCode').css('display', 'inline-block');
                }
            }, 1000);
        }
    });
    $('.submission-form').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        var form = $(this);
        form.parsley().validate();
        if (form.parsley().isValid()) {
            $("#btn-submit").attr('disabled', true);
            $("#loading-spinner").fadeIn();
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.status == 200) {
                        $(form)[0].reset();
                        if(data.message){
                        swal("", data.message, "success", {button: '{{trans('admin.ok')}}'});
                        }
                        if (data.url) {
                            setTimeout(function () {
                                window.location.href = data.url;
                            }, 1000);
                        } else {
                            // $('.modal').modal('hide');
                        }
                    }
                    if(data.status==400){
                        if(data.message){
                            swal("", data.message, "error", {button: '{{trans('admin.ok')}}'});
                        }
                        if (data.url) {
                            setTimeout(function () {
                                window.location.href = data.url;
                            }, 1000);
                        }
                    }
                },
                error: function (response) {
                    errors = response.responseJSON.errors;
                    swal("", errors[Object.keys(errors)[0]][0], "error", {button: '{{trans('admin.ok')}}'});
                }
            });
        } else {
            $("#btn-submit").attr('disabled', false);
        }
    });

    $('.btn-like').on('click',function(){
        var button=$(this);
        var product_id=$(this).attr('data-product');
        $.ajax({
            type: 'POST',
            url: '{{ route('liked') }}',
            data: {product_id: product_id},
            success: function (data) {
                if(data.status==200){
                    if (data.liked==false) {
                        $('#profileLike'+product_id).remove();
                        $(button).find('img').attr('src', '{{asset('public/assets/front/')}}/assets/imgs/home/like.svg');
                        $(button).removeClass('liked');

                        $('#proModal'+product_id).find('.btn-like').find('img').attr('src', '{{asset('public/assets/front/')}}/assets/imgs/home/like.svg');
                        $('#proModal'+product_id).find('.btn-like').removeClass('liked');
                    }
                    else {
                        $(button).find('img').attr('src', '{{asset('public/assets/front/')}}/assets/imgs/home/liked.svg');
                        $(button).addClass('liked');

                        $('#proModal'+product_id).find('.btn-like').find('img').attr('src', '{{asset('public/assets/front/')}}/assets/imgs/home/liked.svg');
                        $('#proModal'+product_id).find('.btn-like').addClass('liked');
                    }
                }
                if(data.status==400){
                    if(data.message){
                        swal("", data.message, "error", {button: '{{trans('admin.ok')}}'});
                    }
                }
            }
        });
    });

    $('.add-to-cart').on('click',function (e) {
        e.preventDefault();
        var product_id=$(this).attr('data-product');
        var redirect=$(this).attr('data-checkout');
        var qty=$(this).closest('.modal-btns').find('.txt-value').val();
        $.ajax({
            type: 'POST',
            url: '{{ route('add-to-cart') }}',
            data: {product_id: product_id,qty:qty},
            success: function (data) {
                if(data.status==200){
                    $('#cart-count').html(data.count);
                    $('#cart-count2').html(data.count);
                    swal("", data.message, "success", {button: '{{trans('admin.ok')}}'});
                    $('.modal').modal('hide');
                    if(redirect){
                        setTimeout(function () {
                            window.location.href = '{{route('cart')}}';
                        }, 1000);
                    }
                }
                if(data.status==400){
                    swal("", data.message, "error", {button: '{{trans('admin.ok')}}'});
                }
            },
            error: function (response) {
                errors = response.responseJSON.errors;
                swal("", errors[Object.keys(errors)[0]][0], "error", {button: '{{trans('admin.ok')}}'});
            }
        })

    });

    $('.incr .plus').on('click', function () {
        var input = $(this).parent().find('input');
        var exVal = parseInt(input.val());
        var val = exVal + 1;
        input.val(val);
    });
    $('.incr .minus').on('click', function () {
        var input = $(this).parent().find('input');
        var exVal = parseInt(input.val());
        if (exVal > 1) {
            var val = exVal - 1;
            input.val(val);
        }
    });

    function checkoutBtn() {
        var currentUrl='{{\Illuminate\Support\Facades\URL::current()}}';
        var checkout='{{route('checkout')}}';
        if(currentUrl==checkout){
            $('#checkoutForm').submit();
        }else{
            window.location.href='{{route('checkout')}}';
        }
    }


</script>
@yield('js')
