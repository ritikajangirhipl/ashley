<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <title>EMS</title> -->
    <title>{{ config('app.name') }} | @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="{{ trans('panel.site_title') }}" />
    <meta name="keywords" content="{{ trans('panel.site_title') }}">
    <meta name="author" content="HIPL" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @include('partials.admin-css')    

    @yield('styles') 
</head>
<body>

    @include('partials.menu')
    @include('partials.header')

    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">

            <div id="pageloader">
               <img src="{{asset('assets/admin/images/ajax-loader.gif')}}" alt="processing..." />
            </div>
            
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <div class="main-body">
                        <div class="page-wrapper">
                            <div class="py-0">
                            @yield('content')
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')

    @include('partials.admin-js')
    <script type="text/javascript">  
        $(document).ready(function() {      
            toastr.options = {
                'closeButton': true,
                'debug': false,
                'newestOnTop': false,
                'progressBar': false,
                'positionClass': 'toast-top-right',
                'preventDuplicates': false,
                'showDuration': '1000',
                'hideDuration': '1000',
                'timeOut': '5000',
                'extendedTimeOut': '1000',
                'showEasing': 'swing',
                'hideEasing': 'linear',
                'showMethod': 'fadeIn',
                'hideMethod': 'fadeOut',
            }
            
            @if(Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch (type) {
              case 'info':
                toastr.info("{{ Session::get('message') }}", 'Info!');
                break;

              case 'warning':
                toastr.warning("{{ Session::get('message') }}", 'Warning!');
                break;
              case 'success':
                toastr.success("{{ Session::get('message') }}", 'Success!');
                break;
              case 'error':
                toastr.error("{{ Session::get('message') }}", 'Error');
                break;
            }
            @endif
        });
        

    </script>
    @yield('scripts') 
    <script type="text/javascript">
        $(document).on('shown.bs.modal', '.modal', function() { 
            $(this).find('[autofocus]').focus();

            // restrict modal to close from clicking outside
            $(this).data('bs.modal')._config.backdrop = 'static';
        });

        // password eye click show password
        $(document).on('click', '.toggle-password', function() {
            var input = $("#password");
            if (input.attr("type") == "password") {
                $('.opened_eye').css('display','block');
                $('.closed_eye').css('display','none');
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
                $('.opened_eye').css('display','none');
                $('.closed_eye').css('display','block');

            }
        });

        // confirm password eye btn
        $(document).on('click', '.toggle-password-confirmation', function() {
            var input = $("#confirm_password");
            if (input.attr("type") == "password") {
                $('.opened_eye_confirmation').css('display','block');
                $('.closed_eye_confirmation').css('display','none');
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
                $('.opened_eye_confirmation').css('display','none');
                $('.closed_eye_confirmation').css('display','block');
            }
        });

        // profile old password eye btn
        $(document).on('click', '.toggle-old-profile-password', function() {
            var input = $("#profile_old_password");
            if (input.attr("type") == "password") {
                $('.opened_eye_old').css('display','block');
                $('.closed_eye_old').css('display','none');
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
                $('.opened_eye_old').css('display','none');
                $('.closed_eye_old').css('display','block');
            }
        });


        // old password
        $(document).on('click', '.toggle-old-password', function() {
            var input = $("#old_password");
            if (input.attr("type") == "password") {
                $(this).removeClass('icofont-eye-blocked')
                $(this).addClass("icofont-eye");
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
                $(this).removeClass('icofont-eye')
                $(this).addClass("icofont-eye-blocked");
            }
        });
        
    </script>

</body>
</html>
<!-- new -->

