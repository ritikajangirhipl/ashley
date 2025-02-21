<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="{{ trans('panel.site_title') }}" />
    <meta name="keywords" content="{{ trans('panel.site_title') }}">
    <meta name="author" content="Codedthemes" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.min.css') }}">
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('assets/admin/images/fav.png') }}" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="{{ asset('assets/admin/fonts/fontawesome/css/fontawesome-all.min.css') }}">
    
    <!-- animation css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/animate.min.css') }}">

    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">

    
</head>
<body>
     <div class="auth-wrapper">
        <div class="auth-content subscribe">
            @if(session('message'))
                <div class="row mb-2">
                    <div class="col-lg-12">
                        <div class="alert alert-success m-4" role="alert">{{ session('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span class="" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>                
            @endif

            <div class="card">
                <div class="row no-gutters">
                    
                    <div class="col-md-4 col-lg-6 d-none d-md-flex d-lg-flex theme-bg align-items-center justify-content-center">
                        <div class="logoadmin"><img src="{{ asset('assets/admin/images/logo_img.png') }}" alt="lock image" class="img-fluid"></div>
                    </div>
                    @yield('content')
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts  -->
    <script src="{{ asset('assets/admin/js/vendor-all.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        $(function(){
          $('#email').bind('input', function(){
            $(this).val(function(_, v){
             return v.replace(/\s+/g, '');
            });
          });
        });
    </script>
    
    @yield('scripts') 
</body>
</html>

    <!-- tap on top starts-->
   

