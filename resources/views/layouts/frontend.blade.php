<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="utf-8"/>
	<title>{{ config('app.name') }} | @yield('title')</title>
    <meta name="description" content="1"/>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <link href="{{asset('assets/plugins/plugins.bundle5883.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css"/>
    @yield('styles') 
</head>
<body id="kt_body" style="background-image: url('{{ asset('assets/images/bg-10.jpg') }}');"  class="quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-enabled page-loading">
    @include('partials.frontend.mobile_navbar')    
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-row flex-column-fluid page">
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                @include('partials.frontend.navbar')
                @yield('content')
                @include('partials.frontend.footer')
            </div>
        </div>
    </div>
    @include('partials.frontend.profile_sidebar')   
    @include('partials.frontend.notification')    

    <script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>  
        <script>
            var KTAppSettings = {
				"breakpoints": {
					"sm": 576,
					"md": 768,
					"lg": 992,
					"xl": 1200,
					"xxl": 1200
				},
				"colors": {
					"theme": {
						"base": {
							"white": "#ffffff",
							"primary": "#6993FF",
							"secondary": "#E5EAEE",
							"success": "#1BC5BD",
							"info": "#8950FC",
							"warning": "#FFA800",
							"danger": "#F64E60",
							"light": "#F3F6F9",
							"dark": "#212121"
						},
						"light": {
							"white": "#ffffff",
							"primary": "#E1E9FF",
							"secondary": "#ECF0F3",
							"success": "#C9F7F5",
							"info": "#EEE5FF",
							"warning": "#FFF4DE",
							"danger": "#FFE2E5",
							"light": "#F3F6F9",
							"dark": "#D6D6E0"
						},
						"inverse": {
							"white": "#ffffff",
							"primary": "#ffffff",
							"secondary": "#212121",
							"success": "#ffffff",
							"info": "#ffffff",
							"warning": "#ffffff",
							"danger": "#ffffff",
							"light": "#464E5F",
							"dark": "#ffffff"
						}
					},
					"gray": {
						"gray-100": "#F3F6F9",
						"gray-200": "#ECF0F3",
						"gray-300": "#E5EAEE",
						"gray-400": "#D6D6E0",
						"gray-500": "#B5B5C3",
						"gray-600": "#80808F",
						"gray-700": "#464E5F",
						"gray-800": "#1B283F",
						"gray-900": "#212121"
					}
				},
				"font-family": "Poppins"
			};
        </script>
    	<script src="{{asset('assets/plugins/plugins.bundle5883.js')}}"></script>
		<script src="{{asset('assets/js/scripts.bundle5883.js')}}"></script>
        <script src="{{asset('assets/js/select5883.js')}}"></script>
        <script src="{{asset('assets/js/record-selection5883.js')}}"></script>
	@yield('scripts')
    </body>
</html>
   

