@extends('layouts.app')

@section('content')
    <h1>Categories</h1>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">Create New Category</a>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- DataTable -->
    {!! $dataTable->table(['class' => 'table table-bordered', 'id' => 'categories-table']) !!}
@endsection

@section('scripts')
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- Include Yajra DataTables Scripts -->
    {!! $dataTable->scripts() !!}

    <!-- Handle Delete Action with AJAX -->
    <script>
        $(document).ready(function() {
            // Handle delete button clicks
            $('#categories-table').on('click', '.delete-btn', function(e) {
                e.preventDefault();

                if (confirm('Are you sure you want to delete this category?')) {
                    const form = $(this).closest('form');
                    const url = form.attr('action');

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _method: 'DELETE',
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // Reload the DataTable
                            $('#categories-table').DataTable().ajax.reload();
                            // Show success message
                            alert('Category deleted successfully!');
                        },
                        error: function(xhr) {
                            alert('An error occurred while deleting the category.');
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>
@endsection