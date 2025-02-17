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
        let fileInput = document.getElementById('image');
        let previewImg = document.getElementById('imagePreview');
        let previewImgLink = document.getElementById('imagePreviewLink'); // New: Link for Fancybox
        let oldImagePreview = document.getElementById('categoryImagePreview');
        let oldImage = oldImagePreview ? oldImagePreview.src : null;

        $("#image").on("change", function(event) {
            let file = event.target.files[0];

            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewImgLink.href = e.target.result; 
                    previewImg.style.display = 'block'; 
                    previewImgLink.style.display = 'block'; 
                    if (oldImagePreview) {
                        oldImagePreview.style.display = 'none'; 
                    }
                };
                reader.readAsDataURL(file);
            } else if (typeof oldImage !== "undefined") {
                previewImg.src = oldImage; 
                previewImgLink.href = oldImage; 
                previewImg.style.display = 'block';
                previewImgLink.style.display = 'block';
                if (oldImagePreview) {
                    oldImagePreview.style.display = 'none';
                }
            }
        });

        $('[data-fancybox="gallery"]').fancybox({
            loop: false
        });
    });

    function submitForm(form) {
        form.submit();
    }
</script>