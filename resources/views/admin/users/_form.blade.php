<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name">{{ trans('cruds.user.fields.name') }}*</label>
    <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($user) ? $user->name : '') }}" required>
    @if($errors->has('name'))
        <p class="help-block">
            {{ $errors->first('name') }}
        </p>
    @endif
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
    <label for="email">{{ trans('cruds.user.fields.email') }}*</label>
    <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($user) ? $user->email : '') }}" required>
    @if($errors->has('email'))
        <p class="help-block">
            {{ $errors->first('email') }}
        </p>
    @endif
</div>
<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
    <label for="password">{{ trans('cruds.user.fields.password') }}</label>
    <input type="password" id="password" name="password" class="form-control" required>
    @if($errors->has('password'))
        <p class="help-block">
            {{ $errors->first('password') }}
        </p>
    @endif
</div>
<div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
    <label for="roles">{{ trans('cruds.user.fields.role') }}*
        {{-- <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
        <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span> --}}
    </label>
    <select name="roles[]" id="roles" class="form-control select2" required>
        <option value="">Select {{ trans('cruds.user.fields.role') }}</option>
        @foreach($roles as $id => $roles)
            <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($user) && $user->roles->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
        @endforeach
    </select>
    @if($errors->has('roles'))
        <p class="help-block">
            {{ $errors->first('roles') }}
        </p>
    @endif
</div>
<div>
    <input class="btn btn-info" type="submit" value="{{ trans('global.save') }}">
</div>