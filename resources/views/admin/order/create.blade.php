@extends('admin.layouts.master')
@section('title', __('admin.add') .' '.__('admin.product'))
@section('content')
    <form class="submission-form" data-parsley-validate novalidate method="POST"
          action="{{ isset($product)?route('product.update',$product->id):route('product.store') }}"
          enctype="multipart/form-data">
    {{ csrf_field() }}
    @isset($product)
        {{ method_field('PUT') }}
    @endisset
    <!-- Page-Title -->
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="btn-group pull-right m-t-15">
                    <button type="button" class="btn btn-custom  waves-effect waves-light"
                            onclick="window.history.back();return false;"> {{trans('admin.back')}} <span
                            class="m-l-5"><i
                                class="fa fa-reply"></i></span>
                    </button>
                </div>
                <h4 class="page-title">@lang('admin.product')</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">{{__('admin.add') .' '.__('admin.product')}}</h4>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="userName">{{trans('admin.name_en')}}* </label>
                            <input type="text" name="name_en"
                                   value="{{isset($product)?$product->name_en: old('name_en') }}"
                                   class="form-control" required
                                   placeholder="{{trans('admin.name_en')}}"
                                   data-parsley-trigger="keyup"
                                   data-parsley-required-message="{{trans('admin.required')}}"
                                   data-parsley-maxlength="20"
                                   data-parsley-maxlength-message="{{trans('admin.max',['max'=>'20','value'=>trans('admin.char')])}}"
                                   data-parsley-minlength="3"
                                   data-parsley-minlength-message="{{trans('admin.min',['min'=>'3','value'=>trans('admin.char')])}}"
                            />
                            @if($errors->has('name_en'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('name_en') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="userName">{{trans('admin.name_ar')}}* </label>
                            <input type="text" name="name_ar"
                                   value="{{isset($product)?$product->name_ar: old('name_ar') }}"
                                   class="form-control" required
                                   placeholder="{{trans('admin.name_ar')}}"
                                   data-parsley-trigger="keyup"
                                   data-parsley-required-message="{{trans('admin.required')}}"
                                   data-parsley-maxlength="20"
                                   data-parsley-maxlength-message="{{trans('admin.max',['max'=>'20','value'=>trans('admin.char')])}}"
                                   data-parsley-minlength="3"
                                   data-parsley-minlength-message="{{trans('admin.min',['min'=>'3','value'=>trans('admin.char')])}}"
                            />
                            @if($errors->has('name_ar'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('name_ar') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="userName">{{trans('admin.category')}}*</label>
                            <select name="cat_id" class="form-control" required
                                    data-parsley-required-message="{{trans('admin.required')}}">
                                <option value="">{{trans('admin.select_category')}}...</option>
                                @foreach($cats as $cat)
                                    <option
                                        {{isset($product)?($product->cat_id==$cat->id?'selected':''):''}} value="{{$cat->id}}">{{$cat->{'name_'.session('lang')} }}</option>
                                @endforeach
                            </select>
                            <p class="help-block" id="error_userName"></p>
                            @if($errors->has('cat_id'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('cat_id') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="userName">{{trans('admin.price')}}*</label>
                            <input type="number" step="any" name="price"
                                   value="{{isset($product)?$product->price: old('price') }}" class="form-control"
                                   required placeholder="{{trans('admin.price')}}"
                                   data-parsley-trigger="keyup"
                                   data-parsley-min=".01"
                                   data-parsley-min-message="{{trans('admin.min_num',['min'=>'.01'])}}"
                                   data-parsley-required-message="{{trans('admin.required')}}"
                                   data-parsley-type-message="{{trans('admin.required_number')}}"
                                   {{--data-parsley-maxlength="55"--}}
                                   {{--data-parsley-maxlength-message="{{trans('admin.max',['max'=>'55','value'=>trans('admin.char')])}}"--}}
                            />
                            <p class="help-block" id="error_userName"></p>
                            @if($errors->has('price'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('price') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="userName">{{trans('admin.image')}}*</label>
                            <input type="file" accept="image/*" name="image" class="form-control"
                                   @if(!isset($product))required
                                   data-parsley-required-message="{{trans('admin.required')}}" @endif/>

                            <p class="help-block" id="error_userName"></p>
                            @if($errors->has('image'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('image') }}
                                </p>
                            @endif
                        </div>
                        @if(isset($product) &&$product->image)
                            <img style="width: 75px; height: 75px;"
                                 src="{{ url('storage/app/public/'.$product->image) }}"/>
                        @endif
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="description_en">{{trans('admin.description_en')}}</label>
                            <textarea rows="5" class="form-control" name="description_en" required
                                      data-parsley-required-message="{{trans('admin.required')}}"
                                      data-parsley-maxlength="200"
                                      data-parsley-maxlength-message="{{trans('admin.max',['max'=>'200','value'=>trans('admin.char')])}}">{{isset($product)?$product->description_en:''}}</textarea>
                            <p class="help-block" id="error_userName"></p>
                            @if($errors->has('description_en'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('description_en') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="description_ar">{{trans('admin.description_ar')}}</label>
                            <textarea rows="5" class="form-control" name="description_ar" required
                                      data-parsley-required-message="{{trans('admin.required')}}"
                                      data-parsley-maxlength="200"
                                      data-parsley-maxlength-message="{{trans('admin.max',['max'=>'200','value'=>trans('admin.char')])}}">{{isset($product)?$product->description_ar:''}}</textarea>
                            <p class="help-block" id="error_userName"></p>
                            @if($errors->has('description_ar'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('description_ar') }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="form-group text-right m-b-0 ">
                            <button class="btn btn-primary waves-effect waves-light m-t-20"
                                    type="submit">{{isset($product)?trans('admin.edit'):trans('admin.add')}}</button>
                            <a href="{{ route('product.index') }}"
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
@endsection
@section('scripts')
    <script type="text/javascript"
            src="{{ request()->root() }}/public/assets/admin/js/validate-{{ session('lang') }}.js"></script>
    <script type="text/javascript">
    </script>
@endsection





