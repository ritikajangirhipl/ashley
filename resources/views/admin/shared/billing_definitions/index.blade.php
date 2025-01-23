@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title float-left">
                    {{ trans('cruds.'.request()->billingType.'.title') }} {{ trans('cruds.billing_definitions.title') }} {{ trans('global.list') }}
                </h4>
                @can('degrees_create')
                    <a class="btn btn-success btn-sm float-right" title="{{ trans('global.add') }}  {{ trans('cruds.billing_definitions.title') }}" href="{{ route('admin.billing-definitions.create',request()->billingType) }}">
                        <i class="fas fa-plus"></i>
                    </a>
                @endcan 
            </div>

            <div class="card-block">
                <div class="table-responsive">
                    <div class="clearfix"></div>
                    {{ $dataTable->table(['class' => 'display table nowrap table-hover', 'style' => 'width:100%;']) }}
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
  $(document).ready( function(){
     @can('degrees_delete')
        $(document).on('change click', '.record_delete_btn', function(e) {
          e.preventDefault();
          var formData = $(this).closest('.deleteRecordForm').serialize();
          var url = $(this).closest('.deleteRecordForm').attr('action');          
          Swal.fire({
              title: "{{ trans('global.areYouSure') }}",
              text: "Do you want to delete this record?",
              icon: "question",
              showCancelButton: true,
              confirmButtonText: "Delete",
            })
            .then((result) => {
              $('#pageloader').css('display', 'flex');
              if (!result.isDismissed) {
                $.ajax({
                  type: "delete",
                  url: url,
                  data: formData,
                  success: function(response) {
                    toastr.success(response.message, 'Success!');
                    $('table').DataTable().ajax.reload(null, false);
                  },
                  error: function(response) {
                    let errorMessages = '';
                    $.each(response.responseJSON.errors, function(key, value) {
                      $.each(value, function(i, message) {
                        errorMessages += '<li>' + message + '</li>';
                      });
                    });
                    toastr.error(errorMessages);
                  },
                  complete: function() {
                    $('#pageloader').css('display', 'none');
                  }
                });
              } else {
                $('#pageloader').css('display', 'none');
                return false;
              }
            });
        });
      @endcan

      // update status  
      $(document).on('click','.billing_definition_status_cb', function(){
          var $this = $(this);
          var dataId = $this.data('id');
          var status = $this.val();
          
          var flag = true;
          var csrf_token = $('meta[name="csrf-token"]').attr('content');
          if($this.prop('checked')){
              flag = false;
          }
          Swal.fire({
                  title: "Are you sure?",
                  text: "Do you want to change status ?",
                  icon: "warning",
                  showDenyButton: true,  
                  showCancelButton: true,  
                  confirmButtonText: "Yes, I am sure",  
                  denyButtonText: "No, cancel it!",
          })
          .then(function(result) {
              if (result.isConfirmed) {  
                  $.ajax({
                      type: 'PUT',
                      url: "{{ route('admin.billingDefinitions.updateStatus',request()->billingType) }}",
                      dataType: 'json',
                      data: { _token: csrf_token, id: dataId, status: status },
                      success: function (response) {
                          if(response.status == 'true') {
                                  Swal.fire({
                                      title: 'Success', 
                                      text: response.message, 
                                      type: "success",
                                      icon: "success",
                                      confirmButtonText: "Okay",
                                      confirmButtonColor: "#04a9f5"
                                  });
                              $('#billing-informations-table').DataTable().ajax.reload(null, false);
                          }
                      },
                      error:function (response){
                          $this.prop('checked', flag);
                          Swal.fire({
                              title: 'Error', 
                              text: 'Something Went wrong!', 
                              type: "Error",
                              icon: "warning",
                              confirmButtonText: "Okay",
                              confirmButtonColor: "#04a9f5"
                          });
                      }
                  });
              }
              else {
                  $this.prop('checked', flag);
              }
          });
      });

  });
</script>
@endsection

