<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#servicePartner-form").validate({
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
            messages: {
                name: {
                    required: "{{ trans('validation.required', ['attribute' => 'name']) }}",
                    minlength: "{{ trans('validation.min.string', ['attribute' => 'name', 'min' => 3]) }}",
                    maxlength: "{{ trans('validation.max.string', ['attribute' => 'name', 'max' => 255]) }}"
                },
                description: {
                    required: "{{ trans('validation.required', ['attribute' => 'description']) }}",
                    maxlength: "{{ trans('validation.max.string', ['attribute' => 'description', 'max' => 500]) }}"
                },
                country_id: {
                    required: "{{ trans('validation.required', ['attribute' => 'country']) }}"
                },
                contact_address: {
                    required: "{{ trans('validation.required', ['attribute' => 'contact address']) }}",
                    minlength: "{{ trans('validation.min.string', ['attribute' => 'contact address', 'min' => 5]) }}",
                    maxlength: "{{ trans('validation.max.string', ['attribute' => 'contact address', 'max' => 255]) }}"
                },
                email_address: {
                    required: "{{ trans('validation.required', ['attribute' => 'email']) }}",
                    email: "{{ trans('validation.email', ['attribute' => 'email']) }}"
                },
                website_address: {
                required: "{{ trans('validation.required', ['attribute' => 'website']) }}",
                url: "{{ trans('validation.url', ['attribute' => 'website']) }}"
                },
                contact_person: {
                    required: "{{ trans('validation.required', ['attribute' => 'contact person']) }}",
                    minlength: "{{ trans('validation.min.string', ['attribute' => 'contact person', 'min' => 3]) }}",
                    maxlength: "{{ trans('validation.max.string', ['attribute' => 'contact person', 'max' => 255]) }}"
                },
                status: {
                    required: "{{ trans('validation.required', ['attribute' => 'status']) }}"
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