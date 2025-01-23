<!--Dropify-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js" integrity="sha512-hJsxoiLoVRkwHNvA5alz/GVA+eWtVxdQ48iy4sFRQLpDrBPn6BFZeUcW4R4kU+Rj2ljM9wHwekwVtsb0RY/46Q==" crossorigin="anonymous"></script>
<script type="text/javascript">
    $("#fees_to_pay").attr('readonly', true);
    $(document).ready( function(){
        var routeName = "{{ Route::currentRouteName() }}";
        if (routeName == 'admin.holder-submissions.edit'){
          getIssuerDegree($(document).find('#issuer_id').val(),$(document).find('#issuer_degree_id').data('selected'));
          getReceiverDegree($(document).find('#receiver_id').val(),$(document).find('#receiver_degree_id').data('selected'));
        };
        // click the issuer
        $(document).on('change','#issuer_id', function(){
            $('#issuer_degree_id').html('<option value="">{{ trans('cruds.holder_submissions.fields.issuer_degree_id') }}</option>');
            if($(this).val()){
                $(this).siblings('.help-block').html('');
                getIssuerDegree($(this).val());
            }
        });

        // click the receiver 
        $(document).on('change','#receiver_id', function(){
            $('#receiver_degree_id').html('<option value="">{{ trans('cruds.holder_submissions.fields.receiver_degree_id') }}</option>');
            if($(this).val()){
                $(this).siblings('.help-block').html('');
                getReceiverDegree($(this).val());
            }
        });

        // get Issuer Degree
        function getIssuerDegree(issuer_id, issuer_degree_id=''){
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

        // click the issuer & receiver degree
        $(document).on('change','#receiver_degree_id,#issuer_degree_id', function(){
            issuerDegreeId = $('#issuer_degree_id').val();
            receiverDegreeId = $('#receiver_degree_id').val();
            billingType = 'issuer';
            if(issuerDegreeId && receiverDegreeId){
                getFeesToPay(issuerDegreeId, receiverDegreeId, billingType);
            }
        });

        //issuer and receiver getFeesToPay
        function getFeesToPay(issuerDegreeId, receiverDegreeId, billingType=''){
          let url = "{{ route('admin.billingFeesToPay.getFeesToPay', ':billingType') }}";
          url = url.replace(':billingType', billingType);
          
          $('#pageloader').css('display', 'flex');
          $.ajax({
              type: "GET",
              dataType:'json',
              url: url,
              data: {
                issuerDegreeId   : issuerDegreeId,
                receiverDegreeId : receiverDegreeId,
              },
              success: function(response){
                if (response.success == true){
                  $("#fees_to_pay").val(response.totalFees);
                  console.log(response.totalFees);
                };
                $('#pageloader').css('display', 'none');
              },
              error: function(response) {
                let errorMessages = '';
                $.each(response.responseJSON.errors, function(i, message) {
                  errorMessages += '<li>' + message + '</li>';
                });
                toastr.error(errorMessages);
                $('#pageloader').css('display', 'none');
              },
          });
        } 

        $("#submission_date").datepicker({
            format: "dd-mm-yyyy",
            locale: 'en',
            endDate: new Date(),
            autoclose: true,
            changeMonth: true,
            changeYear: true,
            orientation: 'auto bottom',
        });

        $(".start_year").datepicker({
          format: 'yyyy',
          endDate: new Date(),
          autoclose: true,
          changeMonth: false,
          changeYear: true,
          minViewMode: 2,
          orientation: 'auto bottom',
        }).on('changeDate', function (selected) {
            var minYear = new Date(selected.date.valueOf());
            $('.end_year').datepicker('setStartDate', minYear);
        });

        $(".end_year").datepicker({
          format: 'yyyy',
          endDate: new Date(),
          autoclose: true,
          changeMonth: false,
          changeYear: true,
          minViewMode: 2,
          orientation: 'auto bottom',
        }).on('changeDate', function (selected) {
          var minYear = new Date(selected.date.valueOf());
          $('.start_year').datepicker('setEndDate', minYear);
        });
        
    });
</script>