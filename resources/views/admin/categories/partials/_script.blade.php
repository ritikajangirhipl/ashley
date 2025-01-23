<script type="text/javascript">
    $(document).ready( function(){
        $(document).on('change','#country_id', function(){
            $('#accreditation_body_id').html('<option value=""> Select Country First </option>');
            if($(this).val()){
                $(this).siblings('.help-block').html('');
                getAccreditationBody($(this).val());
            }
        });

        $(function () {
            country_id = $('#country_id :selected').val();
            if(country_id != ""){
                country_id = $('#country_id :selected').val();
                accreditation_body_id = $('#accreditation_body_id').data('selected');
                getAccreditationBody(country_id, accreditation_body_id);
            }
        });

        // get Accreditation Body
        function getAccreditationBody(country_id, accreditation_body_id=''){
            $('#pageloader').css('display', 'flex');
            $.ajax({
                type: "GET",
                dataType:'json',
                url: "{{ route('admin.accreditationBodies.getAllOptions') }}",
                data: {
                    country_id       : country_id,
                    accreditation_body_id : accreditation_body_id,
                },
                success: function(response){
                    $('#accreditation_body_id').siblings('.help-block').html('');
                    $('#pageloader').css('display', 'none');
                    $("#accreditation_body_id").html(response.options);
                    if(accreditation_body_id != ""){
                        $("#accreditation_body_id").val(accreditation_body_id).trigger('change');
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