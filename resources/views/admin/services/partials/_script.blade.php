<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#service-form").validate({
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
                contact_address: {
                    required: true,
                    minlength: 5,
                    maxlength: 255
                },
                email_address: {
                    required: true,
                    email: true 
                },
                website_address: {
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