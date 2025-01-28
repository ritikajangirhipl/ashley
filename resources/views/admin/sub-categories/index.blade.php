@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title float-left">
                    {{ trans('global.list') }} {{ trans('cruds.sub_category.title') }}
                </h4>
                <a class="btn btn-success btn-sm float-right" title="{{ trans('global.add') }} {{ trans('cruds.sub_category.title_singular') }}" href="{{ route('admin.sub-categories.create') }}">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
            <div class="card-block">
                <div class="table-responsive">
                    <div class="clearfix"></div>
                    {{ $dataTable->table(['class' => 'display table nowrap table-hover', 'id' => 'sub-categories-table', 'style' => 'width:100%;']) }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@parent
{!! $dataTable->scripts() !!}

<script type="text/javascript" src="{{ asset('assets/admin/js/sweet-alert/sweetalert2@9.js') }}"></script>

<script type="text/javascript">
  $(document).ready(function() {
    // Update status
    $(document).on('click', '.sub-categories_status_cb', function() {
        var $this = $(this);
        var dataId = $this.data('id');
        var status = $this.val();
        var flag = true;
        var csrf_token = $('meta[name="csrf-token"]').attr('content');

        if ($this.prop('checked')) {
            flag = false;
        }

        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to change the status?",
            icon: "warning",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Yes, I am sure",
            denyButtonText: "No, cancel it!",
        }).then(function(result) {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'PUT',
                    url: "{{ route('admin.sub-categories.updateStatus') }}",
                    dataType: 'json',
                    data: { _token: csrf_token, id: dataId, status: status },
                    success: function(response) {
                        if (response.status == 'true') {
                            Swal.fire({
                                title: 'Success',
                                text: response.message,
                                icon: "success",
                                confirmButtonText: "Okay",
                                confirmButtonColor: "#04a9f5"
                            });
                            $('#sub-categories-table').DataTable().ajax.reload(null, false);
                        }
                    },
                    error: function(response) {
                        $this.prop('checked', flag);
                        Swal.fire({
                            title: 'Error',
                            text: 'Something went wrong!',
                            icon: "warning",
                            confirmButtonText: "Okay",
                            confirmButtonColor: "#04a9f5"
                        });
                    }
                });
            } else {
                $this.prop('checked', flag);
            }
        });
    });
    // Delete record
    $(document).on("click", ".delete-record", function(event) {
    event.preventDefault();
    var url = $(this).data('href');
    var csrf_token = $('meta[name="csrf-token"]').attr('content');

    Swal.fire({
            title: "{{ trans('global.areYouSure') }}",
            text: "{{ trans('global.onceClickedRecordDeleted') }}",
            icon: "warning",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            denyButtonText: "No, cancel!",
        }).then(function(result) {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    dataType: 'json',
                    data: { _token: csrf_token, _method: "DELETE" },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Success',
                                text: response.message,
                                icon: "success",
                                confirmButtonText: "Okay",
                                confirmButtonColor: "#04a9f5"
                            });
                            $('#sub-categories-table').DataTable().ajax.reload(null, false);
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: response.message,
                                icon: "error",
                                confirmButtonText: "Okay",
                                confirmButtonColor: "#04a9f5"
                            });
                        }
                    },
                    error: function(response) {
                        Swal.fire({
                            title: 'Error',
                            text: 'Something went wrong!',
                            icon: "error",
                            confirmButtonText: "Okay",
                            confirmButtonColor: "#04a9f5"
                        });
                    }
                });
            }
        });
    });
  });
</script>
@endsection