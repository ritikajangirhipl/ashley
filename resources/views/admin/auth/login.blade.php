@extends('layouts.app')
@section('title', __('Login'))
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
            <h3 class="mb-4">{{ __('Login') }}</h3>

            <form method="POST" action="{{ route('admin.loginSubmit') }}">
                @csrf
                <div class="input-group mb-3">
                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('Email') }}" autofocus>
                    
                    @error('email')
                        <span class="invalid-feedback text-left" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="input-group mb-4">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">
                    <span toggle="#password" class="feather icon-eye field-icon toggle-password"></span>
                    @error('password')
                        <span class="invalid-feedback text-left" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group text-left">
                    <div class="checkbox checkbox-fill d-inline">
                        <input class="form-check-input" type="checkbox" name="remember" id="checkbox-fill-a1" {{ old('remember') ? 'checked' : '' }}>
                        <label for="checkbox-fill-a1" class="cr"> Save credentials</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary shadow-2 mb-4">{{ __('Login') }}</button>
            </form>
            @if (Route::has('admin.password.request'))
                <a class="" href="{{ route('admin.password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </div>
    </div>
  </div>
</div>

@endsection
@section('scripts')
<script>
    $(".toggle-password").click(function() {
  $(this).toggleClass("icon-eye icon-eye-off");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
  input.attr("type", "text");
  } else {
  input.attr("type", "password");
  }
});
</script>
@endsection
