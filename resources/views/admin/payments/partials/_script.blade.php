<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $.validator.addMethod("customCurrency", function(value, element) {
            return this.optional(element) || /^[A-Z]{3}$/.test(value);  
        }, "Please enter a valid 3-letter currency code.");

        $("#payment-form").validate({
            rules: {
                order_id: {
                    required: true
                },
                reference_number: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                evidence: {
                    extension: "pdf",
                    filesize: 10240  
                },
                status: {
                    required: true,
                    in: ["successful", "failed"]
                },
                amount: {
                    required: true,
                    number: true,
                    min: 0.01
                },
                currency: {
                    required: true,
                    customCurrency: true
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
