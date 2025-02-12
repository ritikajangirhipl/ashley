<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $.validator.addMethod("customEmail", function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value);
        }, "Please enter a valid email address.");
        $("#verificationProvider-form").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                },
                description: {
                    required: true,
                    maxlength: 255
                },
                provider_type_id: {
                    required: true
                },
                country_id: {
                    required: true
                },
                contact_address: {
                    required: true,
                    minlength: 5,
                    maxlength: 255
                },
                email: {
                    required: true,
                    email: true,
                    customEmail: true 
                },
                website: {
                required: true,  
                url: true
                },
                contact_person: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                status: {
                    required: true
                }
            },
            errorElement: 'span',
            errorClass: 'invalid-feedback',
            errorPlacement: function (error, element) {
                error.appendTo(element.closest('.form-group'));
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
