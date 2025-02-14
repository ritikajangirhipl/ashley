<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#category_id').on('change', function() {
            var category_id = $(this).val();
            console.log('Selected Category:', category_id);
        });

        // Form Validation
        $("#order-form").validate({
            rules: {
                client_id: {
                    required: true
                },
                service_id: {
                    required: true
                },
                country_id: {
                    required: true
                },
                category_id: {
                    required: true 
                },
                reason_for_request: {
                    required: true
                },
                consent_document: {
                    required: true
                },
                reference_provider: {
                    required: true
                },
                address_information: {
                    required: true
                },
                location_id: {
                    required: true
                },
                gender: {
                    required: true
                },
                marital_status: {
                    required: true
                },
                registration_number: {
                    required: true
                },
                status: {
                    required: true
                },
                order_amount: {
                    required: true
                },
                order_payment_status: {
                    required: true
                },
                order_processing_status: {
                    required: true
                }
            },
            errorElement: 'span',
            errorClass: 'invalid-feedback',
            errorPlacement: function (error, element) {
                if (element.hasClass("select2")) {
                    error.appendTo(element.parent());
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
