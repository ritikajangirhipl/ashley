<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        // Initialize form validation
        $("#verification-modes-form").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                    maxlength: 10,
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
                    maxlength: "{{ trans('validation.max.string', ['attribute' => 'name', 'max' => 10]) }}",
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

        function submitForm(form) {
            var formData = new FormData(form);
            var url = $(form).attr('action');
            var method = $(form).attr('method');

            $('input[type="submit"]').prop('disabled', true);

            $.ajax({
                url: url,
                type: method,
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    // Re-enable the submit button
                    $('input[type="submit"]').prop('disabled', false);

                    if (response.success) {
                        Swal.fire({
                            title: 'Success',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "{{ route('admin.verification-modes.index') }}"; // Redirect after success
                            }
                        });
                    } else {
                        // If response.success is false or not present, show a general error message
                        Swal.fire({
                            title: 'Error',
                            text: response.message || 'Something went wrong!',
                            icon: 'error',
                            confirmButtonText: 'OK',
                        });
                    }
                },
                error: function (xhr) {
                    // Re-enable the submit button in case of error
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
                },
            });
        }
    });
</script>