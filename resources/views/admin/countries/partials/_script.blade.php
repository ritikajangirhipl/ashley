<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
$(document).ready(function () {
    var isEdit = $("#countries-form").attr('data-isEdit') === 'true';  
    $.validator.addMethod("currencySymbolOnly", function (value, element) {
        return this.optional(element) || /^[\p{Sc}]+$/u.test(value);
    }, "Only valid currency symbols are allowed.");

    $.validator.addMethod("lettersOnly", function (value, element) {
        return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
    }, "Only letters are allowed.");

    $("#countries-form").validate({
        rules: {
            name: { 
                required: true,
                minlength: 3,
                lettersOnly: true,
            },
            currency_name: { 
                required: true,
                lettersOnly: true
            },
            currency_symbol: { 
                required: true,
                currencySymbolOnly: true
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
        messages: {
            name: { 
                required: "Name is required.",
                minlength: "Name must be at least 3 characters long.",
                lettersOnly: "Only letters are allowed."
            },
            currency_name: {
                required: "Currency name is required.",
                lettersOnly: "Only letters are allowed."
            },
            currency_symbol: {
                required: "Currency symbol is required.",
                currencySymbolOnly: "Only valid currency symbols are allowed."
            },
            description: { 
                required: "Description is required.",
                maxlength: "Description cannot be longer than 255 characters." 
            },
            status: { 
                required: "Status is required." 
            },
            flag: { 
                required: "Flag is required." 
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


