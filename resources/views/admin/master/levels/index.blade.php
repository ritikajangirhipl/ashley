@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')


<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title float-left">
            {{ trans('cruds.levels.title') }} {{ trans('global.list') }}
        </h4>
        @can('level_master_create')
            <a class="btn btn-success btn-sm float-right" id="addBtn" title="{{ trans('global.add') }} {{ trans('cruds.levels.title_singular') }}" href="javascript:void(0);">
                <i class="fas fa-plus"></i>
            </a>
        @endcan 
    </div>

    <div class="card-body">
        <div class="table-responsive normal_width_table">
                <div class="clearfix"></div>
                {{ $dataTable->table(['class' => 'table dt-responsive nowrap', 'style' => 'width:100%;']) }}
            </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" role="dialog" data-focus="false" id="myModal" tabindex="-1" role="dialog" aria-labelledby="popForm" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="m-0 font-weight-bold" id="modal_title">{{ trans('global.add') }} {{ trans('cruds.levels.title_singular') }}</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="my-modal-content"></div>
      </div>  
    </div>
  </div>
</div>
<!-- model end -->

@endsection

@section('scripts')
@parent
{!! $dataTable->scripts() !!}

<script type="text/javascript">
    $(document).ready( function(){
        $("#addBtn").on('click', function () {
            $('.my-modal-content').html('');
            $('#modal_title').text("{{ trans('global.add') }} {{ trans('cruds.levels.title_singular') }}");
            $('#pageloader').css('display', 'flex');
            $.ajax({
                type: 'get',
                url: "{{ route('admin.levels.create') }}",
                dataType: 'json',
                success: function (response) {
                    console.log(response.html);
                    $('#pageloader').css('display', 'none');
                    $('.my-modal-content').html(response.html);
                    $('#myModal').modal('show');
                }
            });
        });

        $(document).on("submit","#createForm", function(event) {
          event.preventDefault();
          var formData = $(this).serialize();
          var url = $(this).attr('action');
          $("#saveButton").prop('disabled', true);
          $(document).find("span.text-danger").remove();
          if (formData != "") {
            $.ajax({
              type: "POST",
              url: url,
              dataType: "json",
              data: formData,
              beforeSend: function() {
                $('#loading-bar-spinner').show();
              },
              success: function(response) {
                $('#createForm')[0].reset();
                $('#myModal').modal('hide');
                toastr.success(response.message, 'Success!');
                $('.dataTable').DataTable().ajax.reload(null, false);
              },
              error: function(response) {
                let errorMessages = '';
                $.each(response.responseJSON.errors, function(field_name, error) {
                  $('<span class="help-block text-danger">' + error + '</span>').insertAfter($(document).find('.'+field_name));
                  $.each(error, function(i, message) {
                    errorMessages += '<li>' + message + '</li>';
                  });
                })
                toastr.error(errorMessages);
              },
              complete: function() {
                $("#saveButton").prop('disabled', false);
                $('.modal-backdrop.show').css('display','none');
              },
            });
          }
        });

      $(document).on("click", ".edit-record", function() {
        $('.my-modal-content').html('');
        $('#modal_title').text("{{ trans('global.edit') }} {{ trans('cruds.levels.title_singular') }}");
        $('#pageloader').css('display', 'flex');
        var url = $(this).attr('data-url');
        $.ajax({
          url: url,
          type: 'GET',
          dataType: 'json',
          success: function(response) {
            $('#pageloader').css('display', 'none');
            $('.my-modal-content').html(response.html);
            $('#myModal').modal('show');            
          },
        });
      });

      $(document).on("submit",'#editForm', function(event) {    
        event.preventDefault();
        var formData = $('#editForm').serialize();
        var url = $('#editForm').attr('action');
        $("#saveButton").prop('disabled', true);
        $(document).find("span.text-danger").remove();
        if (formData != "") {
          $.ajax({
            type: "PUT",
            url: url,
            dataType: "json",
            data: formData,
            success: function(response) {
              $('#editForm')[0].reset();
              $('#myModal').modal('hide');  
              toastr.success(response.message, 'Success!');
              $('.dataTable').DataTable().ajax.reload(null, false);
            },
            error: function(response) {
              let errorMessages = '';
              $.each(response.responseJSON.errors, function(field_name, error) {
                $('<span class="help-block text-danger">' + error + '</span>').insertAfter($(document).find('.'+field_name));
                $.each(error, function(i, message) {
                  errorMessages += '<li>' + message + '</li>';
                });
              })
              toastr.error(errorMessages);
            },
            complete: function() {
              $("#saveButton").prop('disabled', false);
              $('.modal-backdrop.show').css('display','none');
            },
          });
        }
      });

      // delete setting
        $(document).on("click",".delete-record", function(event) {
            event.preventDefault();
            var url = $(this).data('href');
            var csrf_token = $('meta[name="csrf-token"]').attr('content');

            Swal.fire({
                title: "{{ trans('global.areYouSure') }}",
                text: "{{ trans('global.onceClickedRecordDeleted') }}",
                icon: "warning",
                showDenyButton: true,  
                showCancelButton: true,  
                confirmButtonText: "Yes, I am sure",  
                denyButtonText: "No, cancel it!",
            })
            .then(function(result) {
                if (result.isConfirmed) {  
                    $.ajax({
                        type: 'POST',
                        url: url,
                        dataType: 'json',
                        data: { _token: csrf_token,_method: "DELETE" },
                        success: function (response) {
                            if(response.success) {
                                toastr.success(response.message, 'Success!');
                                $('.dataTable').DataTable().ajax.reload(null, false);
                            }
                            else {
                                toastr.success(response.message, 'Error!');
                            }
                        }
                    });
                }
            });
        });

    });

</script>
@endsection