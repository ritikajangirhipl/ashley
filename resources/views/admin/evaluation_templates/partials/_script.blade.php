<script type="text/javascript">
    $(document).ready( function(){
        $(function () {
          receiverId = $('#receiver_id :selected').val();
          if(receiverId != ""){
              receiverId = $('#receiver_id :selected').val();
              receiverDegreeId = $('#receiver_degree_id').data('selected');
              getReceiverDegree(receiverId, receiverDegreeId);
          }

          issuerId = $('#issuer_id :selected').val();
          if(issuerId != ""){
              issuerId = $('#issuer_id :selected').val();
              issuerDegreeId = $('#issuer_degree_id').data('selected');
              getIssuerDegree(issuerId, issuerDegreeId);
          }
        });
        
        // click the issuer
        $(document).on('change','#issuer_id', function(){
            $('#issuer_degree_id').html('<option value="">{{ trans('cruds.evaluation_templates.fields.issuer_degree_id') }}</option>');
            $('#issuer_curriculum_id').html('<option value=""> Select Degree First </option>');
            if($(this).val()){
                $(this).siblings('.help-block').html('');
                type = $(this).data('type');
                getIssuerDegree($(this).val(), type);
            }
        });

        // click issuer degree 
        $(document).on('change','#issuer_degree_id', function(){
            $('#issuer_curriculum_id').html('<option value=""> Select Degree First </option>');
            if($(this).val()){
                $(this).siblings('.help-block').html('');
                getIssuerCurriculums($(this).val());
            }
        });

        // click the receiver 
        $(document).on('change','#receiver_id', function(){
            $('#receiver_degree_id').html('<option value="">{{ trans('cruds.evaluation_templates.fields.receiver_degree_id') }}</option>');
            $('#receiver_curriculum_id').html('<option value=""> Select Degree First </option>');
            if($(this).val()){
                $(this).siblings('.help-block').html('');
                getReceiverDegree($(this).val());
            }
        });

        // click receiver degree 
        $(document).on('change','#receiver_degree_id', function(){
            $('#receiver_curriculum_id').html('<option value=""> Select Receiver Degree First </option>');
            if($(this).val()){
                $(this).siblings('.help-block').html('');
                getReceiverCurriculums($(this).val());
            }
        });

        // get Issuer Degree
        function getIssuerDegree(issuer_id, issuer_degree_id=''){
          //console.log(type);
          $('#pageloader').css('display', 'flex');
          $.ajax({
              type: "GET",
              dataType:'json',
              url: "{{ route('admin.degrees.getAllOptions','issuer') }}",
              data: {
                  degrable_id       : issuer_id,
                  degree_id         : issuer_degree_id,
              },
              success: function(response){
                $('#issuer_degree_id').siblings('.help-block').html('');
                $('#pageloader').css('display', 'none');
                $("#issuer_degree_id").html(response.options);
                if(issuer_degree_id != ""){
                    $("#issuer_degree_id").val(issuer_degree_id).trigger('change');
                    getIssuerCurriculums($(document).find('#issuer_degree_id').val(),$(document).find('#issuer_curriculum_id').data('selected'));
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

        // get Issuer Curriculums
        function getIssuerCurriculums(issuer_degree_id, issuer_curriculum_id=''){
          //console.log(curriculumable_id);
          $('#pageloader').css('display', 'flex');
            $.ajax({
                type: "GET",
                dataType:'json',
                url: "{{ route('admin.curriculums.getAllOptions','issuer') }}",
                data: {
                    degree_id          : issuer_degree_id,
                    curriculum_id      : issuer_curriculum_id,
                },
                success: function(response){
                    $('#issuer_curriculum_id').siblings('.help-block').html('');
                    $('#pageloader').css('display', 'none');
                    $("#issuer_curriculum_id").html(response.options);
                    if(issuer_curriculum_id != ""){
                        $("#issuer_curriculum_id").val(issuer_curriculum_id).trigger('change');
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

        // get Receiver Degree
        function getReceiverDegree(receiver_id, receiver_degree_id=''){
          $('#pageloader').css('display', 'flex');
          $.ajax({
              type: "GET",
              dataType:'json',
              url: "{{ route('admin.degrees.getAllOptions','receiver') }}",
              data: {
                  degrable_id       : receiver_id,
                  degree_id         : receiver_degree_id,
              },
              success: function(response){
                $('#receiver_degree_id').siblings('.help-block').html('');
                $('#pageloader').css('display', 'none');
                $("#receiver_degree_id").html(response.options);
                if(receiver_degree_id != ""){
                    $("#receiver_degree_id").val(receiver_degree_id).trigger('change');
                    getReceiverCurriculums($(document).find('#receiver_degree_id').val(),$(document).find('#receiver_curriculum_id').data('selected'));
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

        // get Receiver Curriculums
        function getReceiverCurriculums(receiver_degree_id, receiver_curriculum_id=''){
          $('#pageloader').css('display', 'flex');
            $.ajax({
                type: "GET",
                dataType:'json',
                url: "{{ route('admin.curriculums.getAllOptions','receiver') }}",
                data: {
                    degree_id          : receiver_degree_id,
                    curriculum_id      : receiver_curriculum_id,
                },
                success: function(response){
                    $('#receiver_curriculum_id').siblings('.help-block').html('');
                    $('#pageloader').css('display', 'none');
                    $("#receiver_curriculum_id").html(response.options);
                    if(receiver_curriculum_id != ""){
                        $("#receiver_curriculum_id").val(receiver_curriculum_id).trigger('change');
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
    });
</script>