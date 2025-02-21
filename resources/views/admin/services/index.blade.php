@extends('layouts.admin')

@section('title', $pageTitle)

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title float-left">
                    {{ trans('panel.page_title.service.list') }}
                </h4>
                <a class="btn btn-success btn-sm float-right" title="{{ trans('global.add') }} {{ trans('cruds.services.title_singular') }}" href="{{ route('admin.services.create') }}">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
            <div class="card-block">
                <div class="table-responsive">
                    <div class="clearfix"></div>
                    {{ $dataTable->table(['class' => 'display table nowrap table-hover', 'id' => 'services-table', 'style' => 'width:100%;']) }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script src="{{ asset('js/common.js') }}"></script>
{!! $dataTable->scripts() !!}

<script type="text/javascript" src="{{ asset('assets/admin/js/sweet-alert/sweetalert2@9.js') }}"></script>

<script type="text/javascript">
  $(document).ready(function() {
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
                        if (response.status) {
                            Swal.fire({
                                title: 'Success',
                                text: response.message,
                                icon: "success",
                                confirmButtonText: "Okay",
                                confirmButtonColor: "#04a9f5"
                            }).then((result) => {
                                if (result.isConfirmed || result.dismiss === Swal.DismissReason.backdrop) {
                                    window.location.href = response.redirect_url; 
                                } else {
                                    $('#services-table-table').DataTable().ajax.reload(null, false); 
                                }
                            });
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