@extends('layouts.app')

@section('content')
    <h1>Country Details</h1>

    <div>
        <strong>Name:</strong> {{ $country->name }}
    </div>
    <div>
        <strong>Flag:</strong>
        <img src="{{ asset('storage/' . $country->flag) }}" alt="{{ $country->name }} Flag" width="100">
    </div>
    <div>
        <strong>Description:</strong> {{ $country->description }}
    </div>
    <div>
        <strong>Currency Name:</strong> {{ $country->currency_name }}
    </div>
    <div>
        <strong>Currency Symbol:</strong> {{ $country->currency_symbol }}
    </div>
    <div>
        <strong>Status:</strong> {{ $country->status }}
    </div>

    <a href="{{ route('countries.index') }}" class="btn btn-primary mt-3">Back to List</a>
@endsection