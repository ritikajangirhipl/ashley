@extends('layouts.app')
@section('content')

<div class="col-md-8 col-lg-6">
    <div class="card-body text-center">
        <div class="row justify-content-center">
            <div class="col-sm-10">

                @if(session('status'))
                    <div class="mb-2">
                            <span class="alert-success px-2 py-1" style="display:block;" role="alert">{{ session('status') }}</span>
                    </div>
                @endif
                <h3 class="mb-4">{{ trans('global.forgot_password_title') }}</h3>
                @if(session('error'))
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <span class="invalid-feedback text-left" style="display:block" role="alert">{{ session('error') }}</>
                        </div>
                    </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}

                    <div class="input-group mb-3">
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', session('oldValue') !== null ? session('oldValue') : '') }}" required autocomplete="email" placeholder="{{ __('Email') }}" autofocus>
                      
                        @error('email')
                            <span class="invalid-feedback text-left" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between custombutton">
                        <button type="submit" class="btn btn-secondary shadow-2 mb-2 mr-1">{{ trans('global.reset_password') }}</button>
    
                        <a href="{{ route('admin.login') }}" class="btn btn-primary shadow-2 mb-2 mr-0">
                            Back to Login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection