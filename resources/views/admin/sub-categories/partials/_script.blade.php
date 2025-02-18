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
        let previewImg = document.getElementById('previewImg');
        let previewImgLink = document.getElementById('previewImgLink');
        let oldImagePreview = document.getElementById('subcategoryImagePreview');
        let oldImage = oldImagePreview ? oldImagePreview.src : null;

        fileInput.addEventListener('change', function(event) {
            let file = event.target.files[0];

            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    if (previewImg) {
                        previewImg.src = e.target.result;
                        previewImgLink.href = e.target.result;
                        previewImg.style.display = 'block';
                        previewImgLink.style.display = 'block';
                    }
                    if (oldImagePreview) {
                        oldImagePreview.style.display = 'none';
                    }

                    $('[data-fancybox="gallery"]').fancybox({
                        loop: false
                    });
                };
                reader.readAsDataURL(file);
            } else if (oldImage) {
                if (previewImg) {
                    previewImg.src = oldImage;
                    previewImgLink.href = oldImage; 
                    previewImg.style.display = 'block'; 
                    previewImgLink.style.display = 'block';
                }
                if (oldImagePreview) {
                    oldImagePreview.style.display = 'none'; 
                }

                $('[data-fancybox="gallery"]').fancybox({
                    loop: false
                });
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