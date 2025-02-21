@extends('layouts.app')

@section('content')


<div class="col-md-8 col-lg-6">
    <div class="card-body text-center">
        <div class="row justify-content-center">
            <div class="col-sm-10">
                <h3 class="mb-4">{{ __('Verify Your Email Address') }}</h3>

                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif

                {{ __('Before proceeding, please check your email for a verification link.') }}
                {{ __('If you did not receive the email') }},
                <form class="d-inline" method="POST" action="{{ route('admin.verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                </form>

            </div>
        </div>
    </div>
</div>

@endsection
