
<!-- General JS Scripts -->
<script src="{{ admin_asset('modules/jquery.min.js') }}"></script>
<script src="{{ admin_asset('modules/popper.js') }}"></script>
<script src="{{ admin_asset('modules/tooltip.js') }}"></script>
<script src="{{ admin_asset('modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ admin_asset('modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ admin_asset('modules/moment.min.js') }}"></script>
<script src="{{ admin_asset('js/stisla.js') }}"></script>

<!-- JS Libraies -->
<script src="{{ admin_asset('modules/simple-weather/jquery.simpleWeather.min.js') }}"></script>
<script src="{{ admin_asset('modules/chart.min.js') }}"></script>
<script src="{{ admin_asset('modules/jqvmap/dist/jquery.vmap.min.js') }}"></script>
<script src="{{ admin_asset('modules/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
<script src="{{ admin_asset('modules/summernote/summernote-bs4.js') }}"></script>
<script src="{{ admin_asset('modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
<script src="{{ admin_asset('modules/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
<script src="{{ admin_asset('modules/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ admin_asset('js/page/components-table.js') }}"></script>

<!-- Advanced Forms -->
<script src="{{ admin_asset('modules/cleave-js/dist/cleave.min.js') }}"></script>
<script src="{{ admin_asset('modules/cleave-js/dist/addons/cleave-phone.us.js') }}"></script>
<script src="{{ admin_asset('modules/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
<script src="{{ admin_asset('modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ admin_asset('modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ admin_asset('modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ admin_asset('modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ admin_asset('modules/select2/dist/js/select2.full.min.js') }}"></script>
{{--<script src="{{ admin_asset('modules/jquery-selectric/jquery.selectric.min.js') }}"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
<script src="{{ admin_asset('js/page/forms-advanced-forms.js') }}"></script>
<script src="{{ admin_asset('modules/codemirror/lib/codemirror.js') }}"></script>
<script src="{{ admin_asset('modules/codemirror/mode/javascript/javascript.js') }}"></script>
<script src="{{ admin_asset('modules/codemirror/mode/php/php.js') }}"></script>
<script src="{{ admin_asset('modules/codemirror/mode/css/css.js') }}"></script>
<script src="{{ admin_asset('modules/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>
<script src="{{ admin_asset('js/page/features-post-create.js') }}"></script>
<script src="{{ admin_asset('js/summernote-ext-highlight.js') }}"></script>
<script src="{{ admin_asset('modules/dropzonejs/min/dropzone.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.5.1/tinymce.min.js" referrerpolicy="origin"></script>
<script src="{{ admin_asset('modules/izitoast/js/iziToast.min.js') }}"></script>
<script src="{{ admin_asset('modules/bootstrap-iconpicker/dist/js/bootstrap-iconpicker.bundle.min.js') }}"></script>

@yield('script')

<script>
    $(document).ready(function () {
        $(".summernote").summernote({
            dialogsInBody: true,
            minHeight: 250,
            followingToolbar: false,
        });

        $(".colorpickerinput").colorpicker({
            format: 'hex',
            component: '.input-group-append',
        });
    })
</script>

<!-- Template JS File -->
<script src="{{ admin_asset('js/scripts.js') }}"></script>
<script src="{{ admin_asset('js/custom.js') }}"></script>
@include('admin.includes.notify')
@if(session('success'))
    <script>
        $(document).ready(function() {
            iziToast.show({
                color: 'green',
                title: 'İşlem başarılı!',
                message: '{{ session('success')  }}',
                position: 'topRight',
                progressBar: true,
                theme: 'light',
            });
        })
    </script>
@elseif(session('error'))
<script>
    $(document).ready(function() {
        iziToast.show({
            color: 'red',
            title: 'İşlem başarısız!!',
            message: '{{ session('error')  }}',
            position: 'topRight',
            progressBar: true,
            theme: 'light',
        });
    })
</script>
@endif
