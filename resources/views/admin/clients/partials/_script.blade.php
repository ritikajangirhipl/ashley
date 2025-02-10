<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#client-form").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                client_type: {
                    required: true
                },
                email_address: {
                    required: true,
                    email: true
                },
                phone_number: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 15
                },

                country_id: {
                    required: true
                },
                contact_address: {
                    required: true,
                    minlength: 5,
                    maxlength: 255
                },
                website_address: {
                    required: true,
                    url: true
                },
                password: {
                    required: true,
                    minlength: 8
                },
                status: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "{{ trans('validation.required', ['attribute' => 'name']) }}",
                    minlength: "{{ trans('validation.min.string', ['attribute' => 'name', 'min' => 3]) }}",
                    maxlength: "{{ trans('validation.max.string', ['attribute' => 'name', 'max' => 255]) }}"
                },
                client_type: {
                    required: "{{ trans('validation.required', ['attribute' => 'client type']) }}"
                },
                email_address: {
                    required: "{{ trans('validation.required', ['attribute' => 'email']) }}",
                    email: "{{ trans('validation.email', ['attribute' => 'email']) }}"
                },
                phone_number: {
                    required: "{{ trans('validation.required', ['attribute' => 'phone number']) }}",
                    digits: "{{ trans('validation.digits', ['attribute' => 'phone number']) }}",
                    minlength: "{{ trans('validation.min.string', ['attribute' => 'phone number', 'min' => 10]) }}",
                    maxlength: "{{ trans('validation.max.string', ['attribute' => 'phone number', 'max' => 15]) }}"
                },
                country_id: {
                    required: "{{ trans('validation.required', ['attribute' => 'country']) }}"
                },
                contact_address: {
                    required: "{{ trans('validation.required', ['attribute' => 'contact address']) }}",
                    minlength: "{{ trans('validation.min.string', ['attribute' => 'contact address', 'min' => 5]) }}",
                    maxlength: "{{ trans('validation.max.string', ['attribute' => 'contact address', 'max' => 255]) }}"
                },
                website_address: {
                    required: "{{ trans('validation.required', ['attribute' => 'website address']) }}",
                    url: "{{ trans('validation.url', ['attribute' => 'website']) }}"
                },
                password: {
                    required: "{{ trans('validation.required', ['attribute' => 'password']) }}",
                    minlength: "{{ trans('validation.min.string', ['attribute' => 'password', 'min' => 8]) }}"
                },
                status: {
                    required: "{{ trans('validation.required', ['attribute' => 'status']) }}"
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
