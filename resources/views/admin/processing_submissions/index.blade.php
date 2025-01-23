@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title float-left">
                    {{ trans('cruds.processing_submissions.title') }} {{ trans('global.list') }}
                </h4>                
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

<script type="text/javascript">
  $(document).ready( function(){
    // update status  
    $(document).on('click','.holder_submission_status_cb', function(){
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
                    url: "{{ route('admin.holderSubmissions.updateStatus') }}",
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
                            $('#students-table').DataTable().ajax.reload(null, false);
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

