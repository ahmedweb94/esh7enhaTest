<script src="{{asset('public/assets/admin/sweetalert/sweetalert.min.js')}}"></script>

@if (Session::has('success'))
    <script>
        window.onload = function () {
            swal("", "{{ Session::get('success') }}", "success",{button:'{{trans('admin.ok')}}'});
            // swal({button:'Done',tit});
        }
    </script>
    @php
        session()->forget('success');
    @endphp
@endif

@if (Session::has('error'))
    <script>
        window.onload = function () {
            swal("", "{{ Session::get('error') }}", "error",{button:'{{trans('admin.ok')}}'});
        }
    </script>
    @php
        session()->forget('error');
    @endphp
@endif
@if (Session::has('info'))
    <script>
        window.onload = function () {
            swal("", "{{ Session::get('info') }}", "info",{button:'{{trans('admin.ok')}}'});
        }
    </script>
    @php
        session()->forget('info');
    @endphp
@endif

@if ($errors->any())
    <script>
        window.onload = function () {
            swal("", "<?php
                    foreach ($errors->all() as $error) {
                        echo $error . '\n';
                    }
                    ?>",
                "error",{button:'{{trans('admin.ok')}}'});
        }
    </script>
@endif
