<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script>
    $(document).ready(function () {
        $.validator.addMethod("lettersOnly", function (value, element) {
            return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
        }, "Only letters are allowed.");

        $("#evidence-type-form").validate({
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
                $(element).addClass('is-invalid');
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

            // Disable the submit button to prevent multiple submissions
            $('button[type="submit"]').prop('disabled', true);

            $.ajax({
                url: url,
                type: method,
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    // Re-enable the submit button
                    $('button[type="submit"]').prop('disabled', false);

                    if (response.status) {
                        Swal.fire({
                            title: 'Success',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "{{ route('admin.evidence-types.index') }}";
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
                    // Re-enable the submit button in case of error
                    $('button[type="submit"]').prop('disabled', false);
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            var input = $('[name="' + key + '"]');
                            input.addClass('is-invalid');
                            input.closest('.form-group').find('.invalid-feedback').remove();
                            input.after('<span class="invalid-feedback">' + value[0] + '</span>');
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'An unexpected error occurred!',
                            icon: 'error',
                            confirmButtonText: 'OK',
                        });
                    }
                }

            });
        }
    });
</script>
