@extends('layouts.app')

@section('content')
    <h1>Edit SubCategory</h1>

    <!-- Display Validation Errors -->
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

    <form action="{{ route('subcategories.update', $subCategory->SubCategoryID) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="CategoryID">Category</label>
            <select name="CategoryID" class="form-control" required>
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->CategoryID }}" {{ $subCategory->CategoryID == $category->CategoryID ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('CategoryID')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="Name">Name</label>
            <input type="text" name="Name" class="form-control" value="{{ old('Name', $subCategory->Name) }}" required>
            @error('Name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="Description">Description</label>
            <textarea name="Description" class="form-control" required>{{ old('Description', $subCategory->Description) }}</textarea>
            @error('Description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="Status">Status</label>
            <select name="Status" class="form-control" required>
                <option value="Active" {{ old('Status', $subCategory->Status) == 'Active' ? 'selected' : '' }}>Active</option>
                <option value="Inactive" {{ old('Status', $subCategory->Status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('Status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success mt-3">Update</button>
    </form>
@endsection