@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')


<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title float-left">
            {{ trans('cruds.permission.title') }} {{ trans('global.list') }}
        </h4>
        @can('permission_create')
            <a class="btn btn-success btn-sm float-right" title="{{ trans('global.add') }} {{ trans('cruds.permission.title_singular') }}" href="{{ route("admin.permissions.create") }}">
                <i class="fas fa-plus"></i>
            </a>
        @endcan 
    </div>

    <div class="card-body">
        <div class="table-responsive normal_width_table">
                <div class="clearfix"></div>
                {{$dataTable->table(['class' => 'table dt-responsive nowrap', 'style' => 'width:100%;'])}}
            </div>
    </div>
</div>

@endsection

@section('scripts')
@parent
{!! $dataTable->scripts() !!}
<script type="text/javascript">
  $(document).ready( function(){
    $(document).on('submit', '.deletePermissionForm', function(e){
        e.preventDefault();
        var formData = $(this).serialize();
        var url = $(this).attr('action');
    
        swal.fire({
            title: "{{ trans('global.areYouSure') }}",
            text: "{{ trans('global.onceClickedRecordDeleted') }}",
            icon: 'question',
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: !0
        }).then(function (e) {
            if (e.value === true) {
                $.ajax({
                    type: 'delete',
                    url: url,
                    data: formData,
                    dataType: 'JSON',
                    success: function (response) {
                        if (response.success == true) {
                            fireSuccessSwal('Success',response.message);
                            setTimeout(function(){
                                location.reload();
                            },1000);
                        } else {
                            fireErrorSwal('Error',response.message);
                        }
                    }
                });

            } else {
                e.dismiss;
            }
        });
    });
  });
</script>
@endsection