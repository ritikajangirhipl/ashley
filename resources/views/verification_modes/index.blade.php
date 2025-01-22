@extends('layouts.app')

@section('content')
    <h1>Verification Modes</h1>
    <a href="{{ route('verification-modes.create') }}" class="btn btn-primary mb-3">Create New Verification Mode</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {!! $dataTable->table(['class' => 'table table-bordered', 'id' => 'verification-modes-table']) !!}
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
            $('#verification-modes-table').on('click', '.delete-btn', function(e) {
                e.preventDefault();

                if (confirm('Are you sure you want to delete this verification mode?')) {
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
                            $('#verification-modes-table').DataTable().ajax.reload();
                            // Show success message
                            alert('Verification Mode deleted successfully!');
                        },
                        error: function(xhr) {
                            alert('An error occurred while deleting the verification mode.');
                            console.error(xhr.responseText); 
                        }
                    });
                }
            });
        });
    </script>
@endsection