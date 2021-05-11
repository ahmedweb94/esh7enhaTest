@extends('front.layouts.master')
@section('title')
    {{trans('admin.profile')}}
@endsection
@section('banner')
    <div class="modal fade" id="mapModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <button class="close" data-dismiss="modal"><span>&times;</span></button>
                <div class="text-center">
                    <h3 class="header green">{{trans('admin.add_new_address')}}</h3>
                </div>
                <form action="{{route('address.store')}}" method="post" enctype="multipart/form-data"
                      class="submission-form1">
                    @csrf
                    <label>{{trans('admin.name')}}</label>
                    <input class="form-control cart-input" name="name" required type="text" data-parsley-trigger="keyup"
                           data-parsley-required-message="{{trans('admin.required')}}">
                    <label>{{trans('admin.region')}}</label>
                    <select class="form-control cart-input" name="region" id="region" required data-parsley-trigger="keyup"
                            data-parsley-required-message="{{trans('admin.required')}}">
                        <option value="">{{trans('admin.select_region')}}..</option>
                        @foreach($regions as $region)
                            <option value="{{$region->id}}">{{$region->{'name_'.session('lang')} }}</option>
                            @endforeach
                    </select>
                    <br>
                    <label>{{trans('admin.city')}}</label>
                    <select class="form-control cart-input" name="city_id" id="city" required data-parsley-trigger="keyup"
                            data-parsley-required-message="{{trans('admin.required')}}">

                    </select>
                    <br>
                    <input type="checkbox" value="1" name="default"> <label>{{trans('admin.is_default')}}</label>
                    <br>
                    <label>{{trans('admin.address')}}</label>
                    <input type="hidden" name="lat" id="lat">
                    <input type="hidden" name="lng" id="lng">
                    <input class="form-control cart-input" id="addressInput" name="address" required type="text"
                           data-parsley-trigger="keyup" data-parsley-required-message="{{trans('admin.required')}}">
                    <label>{{trans('admin.address')}}</label>
                    <div id="us1" style="height: 25rem; width: 100%;"></div>
                    {{--<div id="ad-map"></div>--}}
                    <button type="submit" class="btn-rose full">{{trans('admin.add')}}</button>
                </form>
            </div>
        </div>
    </div>
    @include('front.profile.header')
    <div class="tab-content">
        <!--address-->
        <div class="tab-pane fade show active" id="address2">
            <h4 class="header">{{trans('admin.your_address')}}</h4>
            <h5>{{trans('admin.select_default_address')}}</h5>
            <p>({{trans('admin.address_delivery_message')}})</p>
            @if($address->count()>0)
                <form action="{{route('set-default')}}" method="post" enctype="multipart/form-data"
                      class="submission-form1">
                    @csrf
                    <div id="addressHtml">
                    @foreach($address as $item)
                        <div id="addressNum{{$item->id}}">
                            <div class="pretty p-default p-round mr-b-15">
                                <input type="radio" {{$item->default==1?'checked':''}}  name="address_id"
                                       value="{{$item->id}}">
                                <div class="state">
                                    <label>{{$item->address}} ({{$item->name}})</label>
                                </div>
                            </div>
                            <button type="button" class="btn-icon rose removeAddress" data-id="{{$item->id}}">
                                <img src="{{asset('public/assets/front/')}}/assets/imgs/section/trash.svg" alt="">
                            </button>
                        </div>
                    @endforeach
                    </div>
                    <button type="submit" class="btn-rose">{{trans('admin.save')}}</button>
                </form>
            @endif
            <button type="button" class="btn-add-new" data-toggle="modal" data-target="#mapModal">
                <div class="plus">+</div>
                {{trans('admin.add_new_address')}}
            </button>
        </div>
    </div>
    </section>
@endsection
@section('js')
    <script type="text/javascript"
            src="https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyDBr8fHyX4CFO0PMq4dxJlhPH8RrjXfyN8"></script>
    <script type="text/javascript" src='{{ url('public/locationpicker.jquery.js')}}'></script>
    <script>
        $(document).ready(function () {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showErrors);
            } else {
                alert('Allow Location');
            }

            function showPosition(position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;
                // location(lat,lng);
                $('#us1').locationpicker({
                    location: {
                        latitude: +lat,
                        longitude: +lng,
                    },
                    radius: 200,
                    markerIcon: '{{ asset('public/assets/front/assets/imgs/cart/marker.svg')}}',
                    inputBinding: {
                        latitudeInput: $('#lat'),
                        longitudeInput: $('#lng'),
                        locationNameInput: $('#addressInput')
                    },
                    setCurrentPosition: true,
                    enableAutocomplete: true,
                });
            }

            function showErrors() {
                // location(26.2078,43.4837);
                $('#us1').locationpicker({
                    location: {
                        latitude: 26.2078,
                        longitude: 43.4837,
                    },
                    radius: 200,
                    markerIcon: '{{ asset('public/assets/front/assets/imgs/cart/marker.svg')}}',
                    inputBinding: {
                        latitudeInput: $('#lat'),
                        longitudeInput: $('#lng'),
                        locationNameInput: $('#addressInput')
                    },
                    setCurrentPosition: true,
                    enableAutocomplete: true,
                });
            }

        });

        $('.removeAddress').on('click',function (e) {
            e.preventDefault();
           var address_id=$(this).attr('data-id');
            $.ajax({
                type: 'POST',
                url: '{{route('delete-address')}}',
                data: {address_id: address_id},
                success: function (data) {
                    if (data.status == 200) {
                        if (data.message) {
                            swal("", data.message, "success", {button: '{{trans('admin.ok')}}'});
                        }
                        $('#addressNum'+address_id).remove();
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
        {{--function location(lat,lng) {--}}
        {{--$('#us1').locationpicker({--}}
        {{--location: {--}}
        {{--latitude: +lat,--}}
        {{--longitude: +lng,--}}
        {{--},--}}
        {{--radius: 300,--}}
        {{--markerIcon: '{{ asset('public/assets/front/assets/imgs/cart/marker.svg')}}',--}}
        {{--inputBinding: {--}}
        {{--latitudeInput: $('#lat'),--}}
        {{--longitudeInput: $('#lng'),--}}
        {{--locationNameInput: $('#addressInput')--}}
        {{--},--}}
        {{--setCurrentPosition: true,--}}
        {{--enableAutocomplete: true,--}}
        {{--});--}}
        {{--}--}}

        $('.submission-form1').on('submit', function (e) {
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
                            if (data.message) {
                                swal("", data.message, "success", {button: '{{trans('admin.ok')}}'});
                                form[0].reset();
                            }
                            if(data.html){
                                $('#addressHtml').html(data.html);
                            }
                            if (data.url) {
                                setTimeout(function () {
                                    window.location.href = data.url;
                                }, 1000);
                            } else {
                                $('.modal').modal('hide');
                            }
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
            } else {
                $("#btn-submit").attr('disabled', false);
            }
        });
        $('#region').on('change',function (e) {
            e.preventDefault();
            var id=$(this).val();
            $.ajax({
                type: 'GET',
                url: '{{url('admin/city-by-region/')}}/'+id,
                success: function (data) {
                    if(data){
                        $('#city').empty();
                        $.each(data, function (key, value) {
                            $('#city').append('<option value="' + value.id + '">' + value.name_{{session('lang')}} + '</option>');
                        });
                    }
                },
                error: function (response) {
                    errors = response.responseJSON.errors;
                    swal("", errors[Object.keys(errors)[0]][0], "error", {button: '{{trans('admin.ok')}}'});
                }
            });
        })
    </script>
@endsection
