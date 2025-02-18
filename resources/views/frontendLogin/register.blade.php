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
            <h3 class="mb-4">{{ __('Register') }}</h3>

            <form method="POST" action="{{ route('admin.register') }}">
                @csrf

                <div class="input-group mb-3">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="{{ __('Full Name') }}" autofocus>
                    
                    @error('name')
                        <span class="invalid-feedback text-left" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <select id="client_type" class="form-control @error('client_type') is-invalid @enderror" name="client_type" required>
                        <option value="client1" {{ old('client_type') == 'client1' ? 'selected' : '' }}>{{ __('Client 1') }}</option>
                        <option value="client2" {{ old('client_type') == 'client2' ? 'selected' : '' }}>{{ __('Client 2') }}</option>
                        <option value="client3" {{ old('client_type') == 'client3' ? 'selected' : '' }}>{{ __('Client 3') }}</option>
                        <option value="client4" {{ old('client_type') == 'client4' ? 'selected' : '' }}>{{ __('Client 4') }}</option>
                    </select>

                    @error('client_type')
                        <span class="invalid-feedback text-left" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('Email Address') }}">

                    @error('email')
                        <span class="invalid-feedback text-left" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required placeholder="{{ __('Phone Number') }}">

                    @error('phone')
                        <span class="invalid-feedback text-left" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}" required placeholder="{{ __('Country') }}">

                    @error('country')
                        <span class="invalid-feedback text-left" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input id="website" type="url" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ old('website') }}" placeholder="{{ __('Website Address') }}">

                    @error('website')
                        <span class="invalid-feedback text-left" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('Password') }}">

                    @error('password')
                        <span class="invalid-feedback text-left" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input id="status" type="text" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ old('status') }}" required placeholder="{{ __('Status') }}">

                    @error('status')
                        <span class="invalid-feedback text-left" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group text-left">
                    <div class="checkbox checkbox-fill d-inline">
                        <input class="form-check-input" type="checkbox" name="agree_terms" id="checkbox-fill-a1" {{ old('agree_terms') ? 'checked' : '' }}>
                        <label for="checkbox-fill-a1" class="cr"> {{ __('I agree to the Terms and Conditions') }}</label>
                    </div>
                    @error('agree_terms')
                        <span class="invalid-feedback text-left" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary shadow-2 mb-4">{{ __('Register') }}</button>
            </form>

        </div>
    </div>
  </div>
</div>
@endsection
