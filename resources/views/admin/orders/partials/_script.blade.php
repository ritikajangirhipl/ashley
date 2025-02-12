<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#order-form").validate({
            rules: {
                client_id: {
                    required: true
                },
                service_id: {
                    required: true
                },
                name_of_subject: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                reason_for_request: {
                    required: true
                },
                name_of_reference_provider: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                address_information: {
                    required: true,
                    minlength: 5,
                    maxlength: 500
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
                    required: true,
                    minlength: 5,
                    maxlength: 50
                },
                preferred_currency: {
                    required: true
                },
                order_amount: {
                    required: true,
                    number: true,
                    min: 1
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
                error.appendTo(element.closest('.form-group'));
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
                submitForm(form);
            }
        });
    });
</script>
