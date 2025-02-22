<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script type="text/javascript">
    var rowHtml = $(document).find('.service-fields-outer').last().html();
    function setComboValuesOptions(element=null){
        var elementSelector = ".services_combo_values";
        if(element){
            elementSelector = "#"+element;
            if($(document).find(elementSelector).find('option').length > 0){
                $(document).find(elementSelector).find('option').remove();
            }
        }

        if($(document).find(elementSelector).siblings('.select2-container').length > 0){
            $(document).find(elementSelector).siblings('.select2-container').remove();            
        }
        $(document).find(elementSelector).select2({
            tags: true,
            width:"100%",
        });
    }

    function addServiceFields(thisElement){
        var counter = $(thisElement).attr('data-counter');
        
        counter = parseInt(counter)+1;
        $(thisElement).attr('data-counter',counter);
        // var rowToCopy =  rowHtml;
        
        var rowNumber = $(rowHtml).find('.repeatable-content-service-fields').data('row');
        $(rowHtml).clone().attr('data-row',counter).removeClass('service-field-'+rowNumber)
        .find(".validation-error").remove().end()
        .find(".service_additional_field_id").remove().end()
        .find(".services_field_name").attr('name',"additional_fields["+counter+"][field_name]").attr('id',"services_field_name_"+counter).val("").end()

        .find(".services_combo_values").attr('name',"additional_fields["+counter+"][combo_values][]").attr('id',"services_combo_values_"+counter).removeClass("is-valid select2-hidden-accessible survey-input").addClass("services_combo_values_"+counter).attr('data-select2-id',"services_combo_values_"+counter).val("").end()

        .find(".combo_values_wrap").attr('id','combo_values_wrap_'+counter).end()
        
        .find(".services_field_type").attr('name',"additional_fields["+counter+"][field_type]").attr('id',"services_field_type_"+counter).removeClass("is-valid").val("").end()   

        .find(".services_field_required").attr('name',"additional_fields["+counter+"][field_required]").attr('id',"services_field_required_"+counter).removeClass("is-valid").val("").end()
        .find(".del-field-btn").removeClass('delete_record').addClass('del_field').removeAttr('data-url').attr('data-services',"service-field-"+counter).end()
        .removeClass('service-field-0')
        .addClass("service-field-"+counter)
        .wrap('<div class="service-fields-outer"></div>')
        .parent()
        .appendTo($('.service-fields-details'));

        setComboValuesOptions("services_combo_values_"+counter);    
       
        $("#services_field_type_"+counter).val("");
        $(".services_combo_values"+counter).val("");

        // thisElement.remove();
    }

    var deletedFields = [];
    $(document).ready(function () {

        $('#country_id').on('change', function() {
            var country_id = $(this).val();
            $.ajax({
                url: "{{ route('admin.countries.getCountryDetail') }}",
                type: "POST",
                data: {'country_id' : country_id},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function () {
                    console.log("Request is being sent...");
                },
                success: function (response) {
                    console.log(response);
                    $('#service_currency').val(response.data.currency_name);
                },
                error: function (xhr) {
                    console.log('ajax error:', xhr);
                    
                },
                complete: function () {
                    console.log("Request completed.");
                }
            });
        }).change();

        $(document).on('change','.services_field_type',function(){
            var _this_element = $(this);
            console.log(_this_element.val());
            console.log(_this_element.parents('.services_field_type_wrap').siblings('.combo_values_wrap'));
            if(_this_element.val() == 2){
                _this_element.parents('.services_field_type_wrap').siblings('.combo_values_wrap').show();
            }else{
                _this_element.parents('.services_field_type_wrap').siblings('.combo_values_wrap').hide();
            }
        });

        setComboValuesOptions();
        $('#category_id').on('change', function() {
            var category_id = $(this).val();
            $('#sub_category_id').prop('disabled', true).html(''); 

            if (category_id) {
                $.ajax({
                    url: "{{ route('admin.subcategories.getSubCategories') }}",
                    type: "POST",
                    data: { category_id: category_id },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        console.log("Request is being sent...");
                    },
                    success: function(response) {
                        console.log(response);
                        let html = ''; 
                        if (response.sub_categories && Object.keys(response.sub_categories).length > 0) {
                            $.each(response.sub_categories, function(key, value) {
                                html += '<option value="' + key + '">' + value + '</option>';
                            });
                        } else {
                            html = '<option value="">{{ trans("global.no_sub_categories_found") }}</option>'; 
                        }

                        $('#sub_category_id').html(html).prop('disabled', false);

                    },
                    error: function(xhr) {
                        console.log('AJAX error:', xhr);
                    },
                    complete: function() {
                        console.log("Request completed.");
                    }
                });
            }
        }).change();

        $(document).on('click', '.del_field', function(event) {
            event.preventDefault();

            let fieldsContainer = $('.service-fields-details');
            let fieldRows = fieldsContainer.find('.service-fields-outer');

            let fieldToRemove = $(this).closest('.service-fields-outer');
            let fieldId = fieldToRemove.find('.service_additional_field_id').val(); 

            if (fieldId) {
                deletedFields.push(fieldId);
                $('#delete-additional-fields').val(deletedFields.join(','));
            }

            fieldToRemove.remove();

            let newCounter = $('.service-fields-outer').length;
            $('.add_additional_field').attr('data-counter', newCounter);
        });

        $("#services-form").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                description: {
                    required: true,
                    maxlength: 500
                },
                country_id: {
                    required: true
                },
                category_id: {
                    required: true
                },
                sub_category_id: {
                    required: true
                },
                subject: {
                    required: true
                },
                verification_mode_id: {
                    required: true
                },
                verification_summary: {
                    required: true
                },
                verification_provider_id: {
                    required: true
                },
                verification_duration: {
                    required: true
                },
                evidence_type_id: {
                    required: true
                },
                evidence_summary: {
                    required: true
                },
                service_partner_id: {
                    required: true
                },
                service_currency: {
                    required: true
                },
                local_service_price: {
                    required: true
                },
                usd_service_price: {
                    required: true
                },
                subject_name: {
                    required: true
                },
                copy_of_document_to_verify: {
                    required: true
                },
                reason_for_request: {
                    required: true
                },
                subject_consent_requirement: {
                    required: true
                },
                name_of_reference_provider: {
                    required: true
                },
                address_information: {
                    required: true
                },
                location: {
                    required: true
                },
                gender: {
                    required: true
                },
                registration_number: {
                    required: true
                },
                marital_status: {
                    required: true
                },
                status: {
                    required: true
                }
            },
            errorElement: 'span',
            errorClass: 'invalid-feedback',
            errorPlacement: function (error, element) {
                if (element.hasClass("select2")) {
                    error.appendTo(element.parent());
                } else if (element.is("textarea")) {
                    error.appendTo(element.closest('.form-group'));
                } else {
                    error.appendTo(element.closest('.form-group'));
                }
        },
        highlight: function (element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {
            submitForm(form);
        }
        });
    });
</script>