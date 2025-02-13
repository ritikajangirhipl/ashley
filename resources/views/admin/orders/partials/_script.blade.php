<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $.validator.addMethod("customEmail", function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value);
        }, "Please enter a valid email address.");

        // Initialize form validation
        $("#order-form").validate({
            rules: {
                client_id: {
                    required: true
                },
                service_id: {
                    required: true
                },
                subject_name: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                document: {
                    required: true,
                    extension: "pdf",
                    filesize: 10240 
                },
                reason: {
                    required: true
                },
                subject_consent: {
                    required: true,
                    extension: "pdf",
                    filesize: 10240 
                },
                reference_provider_name: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                address_information: {
                    required: true,
                    minlength: 5,
                    maxlength: 255
                },
                location: {
                    required: true
                },
                gender: {
                    required: true
                },
                payment_status: {
                    required: true
                },
                processing_status: {
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

        // File size validation for PDF files
        $.validator.addMethod("filesize", function(value, element, param) {
            if (element.files.length) {
                return element.files[0].size <= param * 1024;
            }
            return true;
        }, "File size must be less than {0}KB.");
    });
</script>
