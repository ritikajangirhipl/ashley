@extends('layouts.app')

@section('content')
    <h1>Create SubCategory</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('subcategories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="CategoryID">Category</label>
            <select name="CategoryID" class="form-control" required>
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->CategoryID }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('CategoryID')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="Name">Name</label>
            <input type="text" name="Name" class="form-control" value="{{ old('Name') }}" required>
            @error('Name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="Description">Description</label>
            <textarea name="Description" class="form-control" required>{{ old('Description') }}</textarea>
            @error('Description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="Status">Status</label>
            <select name="Status" class="form-control" required>
                <option value="Active" {{ old('Status') == 'Active' ? 'selected' : '' }}>Active</option>
                <option value="Inactive" {{ old('Status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('Status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success mt-3">Create</button>
    </form>
@endsection