@extends('layouts.frontend')
@section('title', trans('panel.forgot_password'))
@section('content')

<div class="content d-flex flex-column flex-column-fluid row-gap-2" id="kt_content">
    <div class="subheader py-2 py-lg-12  subheader-transparent " id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex flex-column">
                    <h2 class="text-white font-weight-bold my-2 mr-5">{{trans('panel.forgot_password')}}</h2>
                    <div class="d-flex align-items-center flex-wrap font-weight-bold my-2 mb-3">
                        <a href="{{route('home')}}" class="opacity-75 hover-opacity-100">
                            <i class="flaticon2-shelter text-white icon-1x"></i>
                        </a>
                        <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                        <a href="{{ route('password.request') }}" class="text-white text-hover-white opacity-75 hover-opacity-100">{{trans('panel.forgot_password')}}</a>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="alert alert-custom alert-white alert-shadow gutter-b" role="alert">
                <div class="alert-icon">
                    <span class="svg-icon svg-icon-primary svg-icon-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z" fill="#000000" opacity="0.3"/>
                                <path d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z" fill="#000000" fill-rule="nonzero"/>
                            </g>
                        </svg>
                    </span>
                </div>
                <div class="alert-text">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                </div>
            </div>
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-body auto_pages">
                    <div class="row align-items-center">
                        <div class="col-lg-6 d-none d-lg-block">
                            <div class="auth_image">
                                <img src="{{asset('assets/images/forgot-password.webp')}}" alt="Forgot Password" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="fields-blog bg-white radius-15">
                                @if(session('status'))
                                    <div class="mb-2">
                                            <span class="alert-success px-2 py-1 text-center" style="display:block;" role="alert">{{ session('status') }}</span>
                                    </div>
                                @endif
                                <h2 class="text-center mb-3">{{ trans('global.forgot_password_title') }}</h2>
                                <p class="text-center mb-5">Enter your email address for your password</p>
                                <form method="POST" action="{{ route('password.email') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label class="col-form-label pt-0">{{ trans('global.login_email') }}</label>
                                        <input type="email" placeholder="Example@site.com" class="form-control @error('email') is-invalid @enderror" name="email">
                                        @error('email')
                                            <span class="invalid-feedback text-left" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-0">
                                        <button type="submit" class="btn btn-primary w-100">{{ trans('global.reset_password') }}</button>
                                        <a href="{{ route('login') }}" class="mb-2 mr-0 mt-4">
                                            Back to Login
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection