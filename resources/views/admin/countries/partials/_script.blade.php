<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    $("#countries-form").validate({
        rules: {
            name: { 
                required: true
            },
            description: { 
                required: true
            },
            status: { 
                required: true 
            },
            flag: { 
                required: true,
            },
        },
        messages: {
            name: { 
                required: "Name is required." 
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

    // Custom method to validate file size
    $.validator.addMethod("filesize", function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param);
    }, "File size must be less than 1 MB.");

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
                    $.each(errors, function (key, value) {
                        toastr.error(value[0]);
                    });
                } else {
                    $('input[type="submit"]').prop('disabled', false);

                    // Handle validation errors
                    var errors = xhr.responseJSON.errors;
                    var errorMessages = '';
                    if (errors) {
                        $.each(errors, function (key, value) {
                            errorMessages += value[0] + '<br>';
                        });
                    } else {
                        // If there are no validation errors, show a generic error message
                        errorMessages = 'An unexpected error occurred!';
                    }

                    Swal.fire({
                        title: 'Error',
                        html: errorMessages,
                        icon: 'error',
                        confirmButtonText: 'OK',
                    });
                }
            },
        });
    }
});

</script>
