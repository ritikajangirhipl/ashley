<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    // Custom validation methods
    $.validator.addMethod("currencySymbolOnly", function (value, element) {
        // Allowing only valid currency symbols and some special characters (no letters or numbers)
        return this.optional(element) || /^[^\w\d\s]+$/.test(value) && /^[\x24\xA3\x20AC\x20A5\x20E2\x82AC]+$/.test(value);
    }, "Only valid currency symbols and limited special characters are allowed.");

    $.validator.addMethod("lettersOnly", function (value, element) {
        return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
    }, "Only letters are allowed.");

    $("#countries-form").validate({
        rules: {
            name: { 
                required: true,
                lettersOnly: true
            },
            currency_name: { 
                required: true,
                lettersOnly: true
            },
            currency_symbol: { 
                required: true,
                currencySymbolOnly: true
            },
            description: { 
                required: true
            },
            status: { 
                required: true 
            },
            flag: { 
                required: true
            },
        },
        messages: {
            name: { 
                required: "Name is required.",
                lettersOnly: "Only letters are allowed."
            },
            currency_name:{
                required: "Currency name is required.",
                lettersOnly: "Only letters are allowed."
            },
            currency_symbol:{
                 required: "Currency symbol is required.",
                 currencySymbolOnly: "Only valid currency symbols and limited special characters are allowed."
            },
            description: { 
                required: "Description is required."
            },
            status: { 
                required: "Status is required." 
            },
            flag: { 
                required: "Flag is required." 
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

    // Function to handle AJAX form submission
    function submitForm(form) {
        var formData = new FormData(form);
        var url = $(form).attr('action');
        var method = $(form).attr('method');

        $.ajax({
            url: url,
            type: method,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Success',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('admin.countries.index') }}";
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: response.message || 'Something went wrong!',
                        icon: 'error',
                        confirmButtonText: 'OK',
                    });
                }
            },
            error: function (xhr) {
                var errors = xhr.responseJSON.errors;
                if (errors) {
                    // Clear previous errors
                    $("#countries-form").find('.is-invalid').removeClass('is-invalid');
                    $("#countries-form").find('.invalid-feedback').text('');

                    // Display new errors below inputs only
                    $.each(errors, function (key, value) {
                        var element = $("#countries-form").find('[name="' + key + '"]');
                        element.addClass('is-invalid');
                        element.closest('.form-group').find('.invalid-feedback').text(value[0]);
                    });

                    // Show Toastr error
                    toastr.error("Please check the form for errors.");
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'An unexpected error occurred!',
                        icon: 'error',
                        confirmButtonText: 'OK',
                    });
                }
            },
        });
    }
});
</script>

