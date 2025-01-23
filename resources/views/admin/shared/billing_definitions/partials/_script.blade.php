<script type="text/javascript">
    $(document).ready(function(){
        evaluationFees = 0.00;
        translationFees = 0.00;
        verificationFees = 0.00;
        otherFees = 0.00;
        receiverFees = 0.0
        $('#evaluation_fees, #translation_fees, #verification_fees, #other_fees, #receiver_fees').on('keyup',function(){
            evaluationFees = $('#evaluation_fees').val();
            translationFees = $('#translation_fees').val();
            verificationFees = $('#verification_fees').val();
            otherFees = $('#other_fees').val();
            receiverFees = $('#receiver_fees').val();
            totalFees = addnumbers(evaluationFees,translationFees,verificationFees,otherFees,receiverFees);
            $('#total_fees').val(totalFees);
        });

        function addnumbers(evaluationFees='', translationFees='',verificationFees='',otherFees='',receiverFees=''){
            return (Number(evaluationFees)+Number(translationFees)+Number(verificationFees)+Number(otherFees)+Number(receiverFees));
        };

        $("#total_fees").attr('readonly', true);

        $(document).on('change','#billable_id', function(){
            $('#degree_id').html('<option value=""> Select {{ ucwords(request()->billingType) }} First </option>');
            if($(this).val()){
                $(this).siblings('.help-block').html('');
                getDegrees($(this).val());
            }
        });

        if($('#billable_id').val() != ""){
            getDegrees($('#billable_id').val(),"{{ old('degree_id', isset($billingDefinition) ? $billingDefinition->degree_id : '') }}",true);
        }
    });

    // get Degrees
    function getDegrees(billable_id, degree_id='',validationErrorShow=false){
        $('#pageloader').css('display', 'flex');
        $.ajax({
            type: "GET",
            dataType:'json',
            url: "{{ route('admin.degrees.getAllOptions',request()->billingType) }}",
            data: {
                degrable_id       : billable_id,
                degree_id         : degree_id,
            },
            success: function(response){
                if(!validationErrorShow){
                    $('#degree_id').siblings('.help-block').html('');
                }
                $('#pageloader').css('display', 'none');
                $("#degree_id").html(response.options);
                if(degree_id != ""){
                    $("#degree_id").val(degree_id).trigger('change');
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
</script>