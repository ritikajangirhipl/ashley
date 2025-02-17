<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var isEdit = $("#countries-form").attr('data-isEdit') === 'true';  
        $("#countries-form").validate({
            rules: {
                name: { 
                    required: true,
                    minlength: 3,
                },
                currency_name: { 
                    required: true,
                },
                currency_symbol: { 
                    required: true,
                },
                description: { 
                    required: true,
                    maxlength: 255 
                },
                status: { 
                    required: true 
                },
                flag: { 
                    required: function (element) {
                        var existingFlag = $("#countries-form").data('existing-flag');
                        if (isEdit && !element.files.length && existingFlag) {
                            return false; 
                        }
                        return true;
                    }
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

        let fileInput = document.getElementById('flagInput');
        let newFlagPreview = document.getElementById('newFlagPreview');
        let newFlagPreviewLink = document.getElementById('newFlagPreviewLink'); 
        let oldFlagPreview = document.getElementById('flagPreview'); 
        let oldFlag = oldFlagPreview ? oldFlagPreview.src : null;

        fileInput.addEventListener('change', function(event) {
            let file = event.target.files[0];

            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    if (newFlagPreview) {
                        newFlagPreview.src = e.target.result;
                        newFlagPreviewLink.href = e.target.result;
                        newFlagPreview.style.display = 'block';
                        newFlagPreviewLink.style.display = 'block';
                    }
                    if (oldFlagPreview) {
                        oldFlagPreview.style.display = 'none'; 
                    }
                    $('[data-fancybox="gallery"]').fancybox({
                        loop: false
                    });
                };
                reader.readAsDataURL(file);
            } else if (oldFlag) {
                if (newFlagPreview) {
                    newFlagPreview.src = oldFlag; 
                    newFlagPreviewLink.href = oldFlag;
                    newFlagPreview.style.display = 'block'; 
                    newFlagPreviewLink.style.display = 'block'; 
                }
                if (oldFlagPreview) {
                    oldFlagPreview.style.display = 'none'; 
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


