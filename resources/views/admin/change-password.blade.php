@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title">
                {{ trans('global.change_password') }}
            </h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.changePassword') }}" id="changePasswordForm" name="changePassword" method="post">
                @csrf
                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="password">{{ trans('cruds.user.fields.password') }}<span class="required">*</span></label>
                    <div class="input-field-inner position-relative">
                        <input type="password" id="password" name="password" class="form-control" autocomplete="false" required>
                        <span class="password-eye" toggle="#password-field">
                            <span class="toggle-password closed_eye svg-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 469.44 469.44">
                                    <path d="m231.15 171.03 67.2 67.2 0.32-3.52c0-35.307-28.693-64-64-64z"/>
                                    <path d="m234.67 128.05c58.88 0 106.67 47.787 106.67 106.67 0 13.76-2.773 26.88-7.573 38.933l62.4 62.4c32.213-26.88 57.6-61.653 73.28-101.33-37.013-93.653-128-160-234.77-160-29.867 0-58.453 5.333-85.013 14.933l46.08 45.973c12.052-4.693 25.172-7.573 38.932-7.573z"/>
                                    <path d="m21.333 69.91 58.347 58.347c-35.2 27.52-63.04 64.107-79.68 106.45 36.907 93.653 128 160 234.67 160 33.067 0 64.64-6.4 93.547-18.027l9.067 9.067 62.187 62.293 27.2-27.093-378.14-378.24-27.2 27.2zm117.97 117.87 32.96 32.96c-0.96 4.587-1.6 9.173-1.6 13.973 0 35.307 28.693 64 64 64 4.8 0 9.387-0.64 13.867-1.6l32.96 32.96c-14.187 7.04-29.973 11.307-46.827 11.307-58.88 0-106.67-47.787-106.67-106.67 0-16.853 4.267-32.64 11.307-46.933z"/>
                                </svg>
                            </span>
                            <span class="toggle-password opened_eye svg-icon" style="display: none;">
                                <svg viewBox="0 0 469.33 469.33" xmlns="http://www.w3.org/2000/svg">
                                <path d="m234.67 170.67c-35.307 0-64 28.693-64 64s28.693 64 64 64 64-28.693 64-64-28.694-64-64-64z"/>
                                <path d="m234.67 74.667c-106.67 0-197.76 66.346-234.67 160 36.907 93.653 128 160 234.67 160 106.77 0 197.76-66.347 234.67-160-36.907-93.654-127.89-160-234.67-160zm0 266.67c-58.88 0-106.67-47.787-106.67-106.67s47.787-106.67 106.67-106.67 106.67 47.787 106.67 106.67-47.787 106.67-106.67 106.67z"/>
                                </svg>

                            </span>
                        </span>
                    </div>
                    @if($errors->has('password'))
                        <p class="help-block">
                            {{ $errors->first('password') }}
                        </p>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('confirm_password') ? 'has-error' : '' }}">
                    <label for="confirm_password">{{ trans('cruds.user.fields.confirm_password') }}<span class="required">*</span></label>
                    <div class="input-field-inner position-relative">
                        <input type="password" id="confirm_password" name="password_confirmation" class="form-control" autocomplete="false" required>
                        <span class="password-eye" toggle="#password-field">
                            <span class="toggle-password-confirmation closed_eye_confirmation svg-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 469.44 469.44">
                                    <path d="m231.15 171.03 67.2 67.2 0.32-3.52c0-35.307-28.693-64-64-64z" />
                                    <path d="m234.67 128.05c58.88 0 106.67 47.787 106.67 106.67 0 13.76-2.773 26.88-7.573 38.933l62.4 62.4c32.213-26.88 57.6-61.653 73.28-101.33-37.013-93.653-128-160-234.77-160-29.867 0-58.453 5.333-85.013 14.933l46.08 45.973c12.052-4.693 25.172-7.573 38.932-7.573z" />
                                    <path d="m21.333 69.91 58.347 58.347c-35.2 27.52-63.04 64.107-79.68 106.45 36.907 93.653 128 160 234.67 160 33.067 0 64.64-6.4 93.547-18.027l9.067 9.067 62.187 62.293 27.2-27.093-378.14-378.24-27.2 27.2zm117.97 117.87 32.96 32.96c-0.96 4.587-1.6 9.173-1.6 13.973 0 35.307 28.693 64 64 64 4.8 0 9.387-0.64 13.867-1.6l32.96 32.96c-14.187 7.04-29.973 11.307-46.827 11.307-58.88 0-106.67-47.787-106.67-106.67 0-16.853 4.267-32.64 11.307-46.933z" />
                                </svg>
                            </span>
                            <span class="toggle-password-confirmation opened_eye_confirmation svg-icon" style="display: none;">
                                <svg viewBox="0 0 469.33 469.33" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m234.67 170.67c-35.307 0-64 28.693-64 64s28.693 64 64 64 64-28.693 64-64-28.694-64-64-64z" />
                                    <path d="m234.67 74.667c-106.67 0-197.76 66.346-234.67 160 36.907 93.653 128 160 234.67 160 106.77 0 197.76-66.347 234.67-160-36.907-93.654-127.89-160-234.67-160zm0 266.67c-58.88 0-106.67-47.787-106.67-106.67s47.787-106.67 106.67-106.67 106.67 47.787 106.67 106.67-47.787 106.67-106.67 106.67z" />
                                </svg>

                            </span>
                        </span>
                    </div>
                    @if($errors->has('confirm_password'))
                        <p class="help-block">
                            {{ $errors->first('confirm_password') }}
                        </p>
                    @endif
                </div>
                <div>
                    <input class="btn btn-info" type="submit" value="Change Password">
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')

<script type="text/javascript">
    $(document).ready(function(){
        
    })
</script>
@endsection 