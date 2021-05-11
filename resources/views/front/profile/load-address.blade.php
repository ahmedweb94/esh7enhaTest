@foreach(\App\Models\Address::where(['user_id'=>auth()->id(),'status'=>1])->orderBy('default','desc')->get() as $item)
    <div id="addressNum{{$item->id}}">
        <div class="pretty p-default p-round mr-b-15">
            <input type="radio" {{$item->default==1?'checked':''}}  name="address_id"
                   value="{{$item->id}}">
            <div class="state">
                <label>{{$item->address}} ({{$item->name}})</label>
            </div>
        </div>
        @if(\Illuminate\Support\Facades\URL::current()==route('address'))
            <button type="button" class="btn-icon rose removeAddress" data-id="{{$item->id}}">
                <img src="{{asset('public/assets/front/')}}/assets/imgs/section/trash.svg" alt="">
            </button>
        @endif
    </div>
@endforeach
<script>
    $('.removeAddress').on('click', function (e) {
        e.preventDefault();
        var address_id = $(this).attr('data-id');
        $.ajax({
            type: 'POST',
            url: '{{route('delete-address')}}',
            data: {address_id: address_id},
            success: function (data) {
                if (data.status == 200) {
                    if (data.message) {
                        swal("", data.message, "success", {button: '{{trans('admin.ok')}}'});
                    }
                    $('#addressNum' + address_id).remove();
                }
                if (data.status == 400) {
                    if (data.message) {
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
    });
</script>
