<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script type="text/javascript">
    var isEdit = $("#categories-form").attr('data-isEdit') === 'true';  
    $(document).ready(function () {
        $("#categories-form").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                },
                image: { 
                    required: function (element) {
                        var existingImage = $("#categories-form").data('existing-image');
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
        let fileInput = document.getElementById('imageInput');
        let previewImg = document.getElementById('categoryImagePreview');
        let oldImage = previewImg ? previewImg.src : null;

        $("#fileInput").on("change", function(event) {
            let file = event.target.files[0];

            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $("#previewImg").attr("src", e.target.result);
                };
                reader.readAsDataURL(file);
            } else if (typeof oldImage !== "undefined") {
                $("#previewImg").attr("src", oldImage);
            }
        });
    });
</script>