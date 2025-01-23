@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')


<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.edit') }} {{ trans('cruds.evaluation_template_mapping.title_singular') }}
        </h4>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.evaluation-template-mappings.update', [$evaluationTemplateMapping->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin/evaluation_template_mapping/partials/_form')
        </form>
    </div>
</div>
    
@endsection

@section('scripts')
@parent
<script type="text/javascript">
$(document).ready( function(){
    // edit page load form field auto fill
    $(function () {
        var evaluation_template_id = $('#evaluation_template_id :selected').val();
        if (evaluation_template_id != '') {
          getAllRecords(evaluation_template_id);
          $("#evaluation-templates").removeAttr("style");
        };
        var removeError = false;

        var issuer_curriculum_details_id = "{{ old('issuer_curriculum_details_id', isset($evaluationTemplateMapping) ? $evaluationTemplateMapping->issuer_curriculum_details_id : null) }}";
        var receiver_curriculum_details_id = "{{ old('receiver_curriculum_details_id', isset($evaluationTemplateMapping) ? $evaluationTemplateMapping->receiver_curriculum_details_id : null) }}";
        getIssuerCurriculumDetails(evaluation_template_id, issuer_curriculum_details_id, removeError);
        getReceiverCurriculumDetails(evaluation_template_id, receiver_curriculum_details_id, removeError);
    });

    $(document).on('change','#evaluation_template_id', function(){
        $('#issuer_curriculum_details_id').html('<option value="">{{ trans('cruds.evaluation_template_mapping.fields.issuer_curriculum_details_id') }}</option>');
        if($(this).val()){
            $(this).siblings('.help-block').html('');
            getIssuerCurriculumDetails($(this).val());
            getReceiverCurriculumDetails($(this).val());
            getAllRecords($(this).val());
        }
    });

    // get Issuer Curriculum Details
    function getIssuerCurriculumDetails(evaluation_template_id, issuer_curriculum_details_id='', removeError=true){
      $('#pageloader').css('display', 'flex');
      $('#issuer_curriculum_details_id').parent('.form-group').removeClass('has-error');
      if(removeError){
        $('#issuer_curriculum_details_id').siblings('.help-block').html('');
      }
      $.ajax({
          type: "GET",
          dataType:'json',
          url: "{{ route('admin.evaluation-template-mappings.getIssuerCurriculumDetailOptions') }}",
          data: {
              evaluation_template_id       : evaluation_template_id,
              issuer_curriculum_details_id : issuer_curriculum_details_id,
          },
          success: function(response){              
              $('#pageloader').css('display', 'none');
              $("#issuer_curriculum_details_id").html(response.options);
              if(issuer_curriculum_details_id != ""){
                  $("#issuer_curriculum_details_id").val(issuer_curriculum_details_id).trigger('change');
              }
          },
          error:function (response){
              $('#pageloader').css('display', 'none');
              $.each(response.responseJSON.errors, function (key, item) {
                  $('.error_'+key).html(item);
                  $('.error_'+key).show();
              });
          }
      });
    }

    // get Receiver Curriculum Details
    function getReceiverCurriculumDetails(evaluation_template_id, receiver_curriculum_details_id='', removeError=true){
      $('#pageloader').css('display', 'flex');
      $('#receiver_curriculum_details_id').parent('.form-group').removeClass('has-error');
      if(removeError){
        $('#receiver_curriculum_details_id').siblings('.help-block').html('');
      }
      $.ajax({
          type: "GET",
          dataType:'json',
          url: "{{ route('admin.evaluation-template-mappings.getReceiverCurriculumDetailOptions') }}",
          data: {
              evaluation_template_id       : evaluation_template_id,
              receiver_curriculum_details_id : receiver_curriculum_details_id,
          },
          success: function(response){            
              $('#pageloader').css('display', 'none');
              $("#receiver_curriculum_details_id").html(response.options);
              if(receiver_curriculum_details_id != ""){
                  $("#receiver_curriculum_details_id").val(receiver_curriculum_details_id).trigger('change');
              }
          },
          error:function (response){
              $('#pageloader').css('display', 'none');
              $.each(response.responseJSON.errors, function (key, item) {
                  $('.error_'+key).html(item);
                  $('.error_'+key).show();
              });
          }
      });
    }

    // get evaluation template list
    function getAllRecords(evaluation_template_id){
      $('#pageloader').css('display', 'flex');
      $.ajax({
          type: "GET",
          dataType:'json',
          url: "{{ route('admin.evaluationTemplates.getAllRecords') }}",
          data: {
              evaluation_template_id : evaluation_template_id,
          },
          success: function(response){
            $('#pageloader').css('display', 'none');
            $("#issuer_id").html(response.issuer_id);
            $("#issuer_degree_id").html(response.issuer_degree_id);
            $("#issuer_curriculum_id").html(response.issuer_curriculum_id);
            $("#receiver_id").html(response.receiver_id);
            $("#receiver_degree_id").html(response.receiver_degree_id);
            $("#receiver_curriculum_id").html(response.receiver_curriculum_id);
          },
          error:function (response){
              $('#pageloader').css('display', 'none');
              $.each(response.responseJSON.errors, function (key, item) {
                  $('.error_'+key).html(item);
                  $('.error_'+key).show();
              });
          }
      });
    }
});
</script>
@endsection