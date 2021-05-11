@extends('admin.layouts.master')
@section('title',  __('admin.order'))
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="btn-group pull-right m-t-15">
                <button type="button" class="btn btn-custom  waves-effect waves-light"
                        onclick="window.history.back();return false;"> @lang('maincp.back') <span class="m-l-5"><i
                            class="fa fa-reply"></i></span>
                </button>
            </div>
            <h4 class="page-title">{{trans('admin.order_details')}}</h4>
        </div>
    </div>
    <!-- Modal -->
    <div id="print-invoice" class="modal-demo">
        <button type="button" class="close" onclick="Custombox.close();">
            <span>&times;</span><span class="sr-only">Close</span>
        </button>
        <h4 class="custom-modal-title">{{trans('admin.invoice')}}</h4>
        <div class="custom-modal-text">
            <div id="divToPrint">
                <div style="text-align: center; margin: 0 auto;">
                    <div style="float: right;">
                        <h1 style="margin-bottom: 0px;"> # {{ $result['id'] }}</h1>
                        <p style="margin-top: 5px;">{{trans('admin.date')}}: {{ $result['created_at'] }}</p>
                    </div>
                    <div style="float: left;">
                        <img style=" margin-top: 10px; width: 50%;" src="{{asset('public/assets/front/')}}/assets/imgs/home/logo@2x.png"/>
                    </div>
                </div>
                <div style="clear: both;"></div>
                <table width="100%" style="margin-bottom: 10px; direction: {{session('lang')=='ar'?'rtl':'ltr'}};">
                    <tr>
                        <td width="60%" style="border: 1px solid #000">
                            <div style="padding: 10px;">
                                <strong>{{trans('admin.client')}}:</strong>
                                <br/>
                                {{ $result->user->name }}
                                <br/>
                                {{ $result->user->mobile }}
                                <br/>
                                {{@$result->address->address}}
                            </div>
                        </td>
                        <td width="40%" style="border: 1px solid #000">
                            <div style="padding: 10px;">
                                <strong>{{trans('admin.site_name')}}</strong><br/>
                                <span style="direction: {{session('lang')=='ar'?'ltr':'rtl'}};
                                    text-align:{{session('lang')=='ar'?'right':'left'}}">
                                   {{--{{ $setting->getBody('contact_phone')  }}--}}
                               </span>
                                <br/>{{trans('admin.payment_type')}}: {{ trans('admin.'.$result->payment_type)}}
                                <br/> {{trans('admin.payment_status')}}:{{ trans('admin.'.$result->payment_status)}}
                            </div>
                        </td>
                    </tr>
                </table>
                <table class="table table-bordered" style="width: 100%;  direction: {{session('lang')=='ar'?'rtl':'ltr'}};">
                    <thead>
                    <tr>
                        <th style="border: 1px solid #000; text-align: center">{{trans('admin.product')}}</th>
                        <th style="border: 1px solid #000; text-align: center">{{trans('admin.qty')}}</th>
                        <th style="border: 1px solid #000; text-align: center">{{trans('admin.price')}}</th>
                        <th style="border: 1px solid #000; text-align: center">{{trans('admin.total')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $total = 0; ?>
                    @foreach($result->details as $key => $product)
                        <tr>
                            <td style="border: 1px solid #000; text-align: center">
                                {{ $product->product->{'name_'.session('lang')} }}
                            </td>
                            <td style="border: 1px solid #000; text-align: center">
                                {{ $product['qty'] }}
                            </td>
                            <td style="border: 1px solid #000; text-align: center">
                                {{$product['price'] }} {{trans('admin.sar')}}
                            </td>
                            <td style="border: 1px solid #000; text-align: center">
                                {{ number_format($product['qty']*$product['price'],2) }} {{trans('admin.sar')}}
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th style="border: 1px solid #000; text-align: center;" colspan="1">{{trans('admin.total')}}</th>
                        <th style="border: 1px solid #000; text-align: center;"
                            colspan="3">{{ number_format($result->price, 2) }}  {{trans('admin.sar')}}</th>
                    </tr>
                    <tr>
                        <th style="border: 1px solid #000; text-align: center;" colspan="1">{{trans('admin.delivery_fees')}}</th>
                        <th style="border: 1px solid #000; text-align: center;"
                            colspan="3">{{ number_format($result['delivery_fees'], 2) }} {{trans('admin.sar')}}
                        </th>
                    </tr>
                    <tr>
                        <th style="border: 1px solid #000; text-align: center;" colspan="1">{{trans('admin.total')}}</th>
                        <th style="border: 1px solid #000; text-align: center;"
                            colspan="3">{{ number_format($result->delivery_fees + $result->price, 2) }}
                            ريال
                        </th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <input type="button" class="btn btn-primary" value="{{trans('admin.print')}}" onclick="printDiv()">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="card-box">
                <div class="row">
                    <div class="col-xs-12 col-lg-12">
                        <h4>{{trans('admin.order_details')}}</h4>
                        <hr>
                    </div>
                    <input type="hidden" id="lat" value="{{@$result->address->lat}}">
                    <input type="hidden" id="lng" value="{{@$result->address->long}}">
                    <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.id')}}:</label>
                        <p>{{ $result->id }}</p>
                    </div>
                    <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.client')}}:</label>
                        <p>{{ @$result->user->name }}</p>
                    </div>
                    <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.mobile')}}:</label>
                        <p>{{ @$result->user->mobile }}</p>
                    </div>
                    <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.delivery_fees')}}:</label>
                        <p>{{  $result->delivery_fees}} {{trans('admin.sar')}}</p>
                    </div>
                    <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.total')}}:</label>
                        <p>{{  $result->delivery_fees + $result->price}} {{trans('admin.sar')}}</p>
                    </div>
                    <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.status')}}:</label>
                        <p>{{ trans('admin.'.$result->status)}}</p>
                    </div>
                    <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
                        <label>@lang('admin.date') :</label>
                        <p>{{date('H:i:s || Y/m/d', strtotime($result->created_at))  }} </p>
                    </div>
                    <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.payment_type')}}:</label>
                        <p>{{ trans('admin.'.$result->payment_type)}}</p>
                    </div>
                    <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.payment_status')}}:</label>
                        <p>{{ trans('admin.'.$result->payment_status)}}</p>
                    </div>
                    <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.delivery_time')}}:</label>
                        <p>{{ trans('admin.in_hour',['hour'=>$result->delivery_time])}}</p>
                    </div>
                    <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.region')}}:</label>
                        <p>{{@$result->address->city->region->{'name_'.session('lang')} }}</p>
                    </div>
                    <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.city')}}:</label>
                        <p>{!!  @$result->address->city->{'name_'.session('lang')} !!}</p>
                    </div>
                    <div class="col-lg-12 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.address')}}:</label>
                        <p>{!!  @$result->address->address !!}</p>
                    </div>

                    <div class="col-lg-12 col-xs-12 col-md-6 col-sm-6">
                        <div>
                            <h5>{{trans('admin.address')}}</h5>
                            <input name="lat" type="hidden"  id="lat" value="{{@$result->address->lat}}">
                            <input name="lng" type="hidden" id="lng" value="{{@$result->address->lng}}">
                            <div style="width: 100%; height: 300px;">
                                <div id="us1" style="height: 285px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="pull-right">
                        <a href="#print-invoice"
                           class="btn btn-primary btn-trans waves-effect waves-light m-r-5 m-b-10"
                           data-animation="fadein" data-plugin="custommodal"
                           data-overlaySpeed="200" data-overlayColor="#36404a">{{trans('admin.invoice')}}</a>
                        </div>
                        <label>{{trans('admin.product_details')}}:</label>
                        <div class="tabel-resp">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{trans('admin.name')}}</th>
                                    <th>{{trans('admin.qty')}}</th>
                                    <th>{{trans('admin.price')}}</th>
                                    <th>{{trans('admin.total')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($result->details as $key => $product)
                                    <tr>
                                        <th>{{$loop->iteration }}</th>
                                        <td>{{ $product->product->{'name_'.session('lang')} }}</td>
                                        <td>{{ $product['qty'] }}</td>
                                        <td>{{$product['price'] }} {{trans('admin.sar')}}</td>
                                        <td>{{ number_format($product['qty']*$product['price'],2) }} {{trans('admin.sar')}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th align="center" colspan="4">{{trans('admin.total')}}</th>
                                    <th>{{ number_format($result->price, 2) }}  {{trans('admin.sar')}}</th>
                                </tr>
                                <tr>
                                    <th align="center" colspan="4">{{trans('admin.delivery_fees')}}</th>
                                    <th>{{ number_format($result['delivery_fees'], 2) }}  {{trans('admin.sar')}}</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {{--<script async defer--}}
            {{--src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBr8fHyX4CFO0PMq4dxJlhPH8RrjXfyN8&amp;callback=initAutocomplete">--}}
    {{--</script>--}}
    <script type="text/javascript"
            src="https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyDBr8fHyX4CFO0PMq4dxJlhPH8RrjXfyN8"></script>
    <script type="text/javascript" src='{{ url('public/locationpicker.jquery.js')}}'></script>
    <script>
        function printDiv() {
            var divContents = document.getElementById("divToPrint").innerHTML;
            var a = window.open('', '', 'height=500, width=500');
            a.document.write('<html>');
            a.document.write('<body>');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.print();
        };

        $('#us1').locationpicker({
            location: {
                latitude: '{{@$result->address->lat}}',
                longitude: '{{@$result->address->lng}}',
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
    </script>
@endsection
