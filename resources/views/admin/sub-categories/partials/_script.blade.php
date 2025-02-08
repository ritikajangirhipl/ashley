<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var isEdit = $("#sub-categories-form").attr('data-isEdit') === 'true';  
        $("#sub-categories-form").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                },
                image: { 
                    required: function (element) {
                        var existingImage = $("#sub-categories-form").data('existing-image');
                        if (isEdit && !element.files.length && existingImage) {
                            return false; 
                        }
                        return true;
                    }
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
                },
                image: { 
                    required: "{{trans('validation.required', ['attribute' => 'image']) }}" 
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

        let fileInput = document.getElementById('imageInput');
        let previewImg = document.getElementById('subcategoryImagePreview');
        let oldImage = previewImg ? previewImg.src : null;

        fileInput.addEventListener('change', function(event) {
            let file = event.target.files[0]; 

            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else if (oldImage) {
                previewImg.src = oldImage;
            }
        });  
    });
</script>