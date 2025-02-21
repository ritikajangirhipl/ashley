@extends('layouts.app')
@section('title', trans('global.reset_password'))
@section('content')

<div class="col-md-8 col-lg-6">
    <div class="card-body text-center">
        <div class="row justify-content-center">
            <div class="col-sm-10">
                <h3 class="mb-4">{{ trans('global.reset_password') }}</h3>

                <form method="POST" action="{{ route('admin.password.update') }}">
                {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{ request()->route('token') }}">
                    <div class="input-group mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('E-Mail Address') }}" autofocus>
                      
                        @error('email')
                            <span class="invalid-feedback text-left" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-4">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="password" placeholder="{{ __('Password') }}">

                        @error('password')
                            <span class="invalid-feedback text-left" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-4">
                        <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="password_confirmation" placeholder="{{ __('Confirm Password') }}">

                        @error('password_confirmation')
                            <span class="invalid-feedback text-left" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary shadow-2 mb-4">{{ trans('global.reset_password') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
