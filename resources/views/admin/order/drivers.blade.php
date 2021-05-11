<form class="submission-form2" data-parsley-validate novalidate method="POST"
      action="{{ route('order.assign') }}" enctype="multipart/form-data">
{{ csrf_field() }}
<!-- Page-Title -->
    <div class="row">
        <div class="col-lg-10 col-lg-offset-2">
            <div class="card-box">
                <h4 class="header-title m-t-0 m-b-30">{{__('admin.assign_to_driver')}}</h4>
                <input type="hidden" name="order_id" value="{{$id}}">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="userName">{{trans('admin.driver')}}*</label>
                        <select name="driver_id" class="form-control" required
                                data-parsley-required-message="{{trans('admin.required')}}">
                            <option value="">{{trans('admin.select_driver')}}...</option>
                            @foreach($drivers as $driver)
                                <option value="{{$driver->id}}">{{$driver->name}}</option>
                            @endforeach
                        </select>
                        <p class="help-block" id="error_userName"></p>
                        @if($errors->has('driver_id'))
                            <p class="help-block validationStyle">
                                {{ $errors->first('driver_id') }}
                            </p>
                        @endif
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group text-right m-b-0 ">
                        <button class="btn btn-primary waves-effect waves-light m-t-20"
                                type="submit">{{isset($city)?trans('admin.edit'):trans('admin.add')}}</button>
                        <a href="{{ route('city.index') }}"
                           class="btn btn-default waves-effect waves-light m-l-5 m-t-20"> @lang('admin.cancel')
                        </a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div><!-- end col -->
    </div>
    <!-- end row -->
</form>
