@extends('front.layouts.master')
@section('title')
    {{trans('admin.profile')}}
@endsection
@section('banner')
    @include('front.profile.header')
    <div class="tab-content">
        <!--password-->
        <div class="tab-pane fade show active" id="password">
            <h4 class="header">{{trans('admin.your_profile_data')}}</h4>
            <form action="{{route('change-password')}}" method="post" enctype="multipart/form-data"
                  class="submission-form1">
                @csrf
            <div class="row">
                <div class="col-md-6">
                    <label>{{trans('admin.old_password')}}</label>
                    <input class="form-control cart-input" type="password" required name="old_password" placeholder="{{trans('admin.old_password')}}"
                           data-parsley-trigger="keyup"
                           data-parsley-required-message="{{trans('admin.required')}}"
                           data-parsley-minlength="6"
                           data-parsley-minlength-message="{{trans('admin.min',['min'=>'6','value'=>trans('admin.char')])}}">
                    <label>{{trans('admin.new_password')}}</label>
                    <input class="form-control cart-input" type="password" name="password" placeholder="{{trans('admin.new_password')}}"
                           data-parsley-trigger="keyup"
                           data-parsley-required-message="{{trans('admin.required')}}"
                           data-parsley-minlength="6"
                           data-parsley-minlength-message="{{trans('admin.min',['min'=>'6','value'=>trans('admin.char')])}}">
                    <label>{{trans('admin.password_confirmation')}}</label>
                    <input class="form-control cart-input" name="password_confirmation" type="password" placeholder="{{trans('admin.password_confirmation')}}"
                           required
                           data-parsley-trigger="keyup"
                           data-parsley-required-message="{{trans('admin.required')}}"
                           data-parsley-minlength="6"
                           data-parsley-minlength-message="{{trans('admin.min',['min'=>'6','value'=>trans('admin.char')])}}">
                    <button type="submit" class="btn-rose full">{{trans('admin.save')}}</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    </section>
@endsection
@section('js')
    <script>
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
                            if (data.url) {
                                setTimeout(function () {
                                    window.location.href = data.url;
                                }, 1000);
                            } else {
                                // $('.hide-modal').modal('hide');
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
    </script>
@endsection
