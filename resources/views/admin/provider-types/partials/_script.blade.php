<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#provider-type-form").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                },
                description: {
                    required: true,
                    maxlength: 255,
                },
                status: {
                    required: true,
                },
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
            },
        });
    });
</script>
