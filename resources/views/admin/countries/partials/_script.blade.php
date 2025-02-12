<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
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
    let previewImg = document.getElementById('flagPreview');
    let oldImage = previewImg.src;

    fileInput.addEventListener('change', function(event) {
        let file = event.target.files[0]; 

        if (file) {
            let reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
            };
            reader.readAsDataURL(file);
        } else {
            previewImg.src = oldImage;
        }
    });  
});
</script>


