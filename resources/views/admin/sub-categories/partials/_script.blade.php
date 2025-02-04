<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $.validator.addMethod("lettersOnly", function (value, element) {
            return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
        }, "Only letters are allowed.");
        $("#sub-categories-form").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                    lettersOnly: true,
                },
                description: {
                    required: true,
                    maxlength: 255,
                },
                status: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: "{{ trans('validation.required', ['attribute' => 'name']) }}",
                    minlength: "{{ trans('validation.min.string', ['attribute' => 'name', 'min' => 3]) }}",
                    lettersOnly: "Only letters are allowed."
                },
                description: {
                    required: "{{ trans('validation.required', ['attribute' => 'description']) }}",
                    maxlength: "{{ trans('validation.max.string', ['attribute' => 'description', 'max' => 255]) }}",
                },
                status: {
                    required: "{{ trans('validation.required', ['attribute' => 'status']) }}",
                },
            },
            errorElement: 'span',
            errorClass: 'invalid-feedback',
            errorPlacement: function (error, element) {
                error.appendTo(element.closest('.form-group'));
            },
            highlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
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