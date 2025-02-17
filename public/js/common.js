
function submitForm(form) {
    var formData = new FormData(form);
    var url = $(form).attr('action');
    var method = $(form).attr('method');

    $.ajax({
        url: url,
        type: method,
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
            $('button[type="submit"], input[type="submit"]').prop('disabled', true);
        },
        success: function (response) {
            if (response.status) {
                Swal.fire({
                    title: 'Success',
                    text: response.message,
                    icon: 'success',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    if (result.isConfirmed || result.dismiss === Swal.DismissReason.backdrop) {
                        window.location.href = response.redirect_url;
                    }
                });
            } else {
                if (response.status === 400 && response.message === 'The selected category does not exist.') {
                    Swal.fire({
                        title: 'Error',
                        text: 'The selected category does not exist.',
                        icon: 'error',
                        confirmButtonText: 'OK',
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: response.message || 'Something went wrong!',
                        icon: 'error',
                        confirmButtonText: 'OK',
                    });
                }
            }
        },
        error: function (xhr) {
            $('button[type="submit"], input[type="submit"]').prop('disabled', false);

            if (xhr.status === 422) {
                var errors = xhr.responseJSON.errors;
                $.each(errors, function (key, value) {
                    let input = $('[name="' + key + '"]');
                    input.addClass('is-invalid');
                    input.closest('.form-group').find('.invalid-feedback').remove();
                    input.after('<span class="invalid-feedback">' + value[0] + '</span>');
                });
            } else {
                Swal.fire({
                    title: 'Error',
                    text: xhr.responseJSON.message || 'An unexpected error occurred!',
                    icon: 'error',
                    confirmButtonText: 'OK',
                });
            }
        },
        complete: function () {
            $('button[type="submit"], input[type="submit"]').prop('disabled', false);
        }
    });
}


function previewImage(inputId, previewId) {
    let fileInput = $('#' + inputId);
    let previewImg = $('#' + previewId);
    let oldImage = previewImg.attr('src'); 

    fileInput.on('change', function(event) {
        let file = event.target.files[0];

        if (file) {
            let reader = new FileReader();
            reader.onload = function(e) {
                previewImg.attr('src', e.target.result); 
            };
            reader.readAsDataURL(file);
        } else {
            previewImg.attr('src', oldImage);
        }
    });
}

$(document).ready(function () {
    previewImage("flag", "countryFlagPreview");
    previewImage("image", "categoryImagePreview");
    previewImage("image", "subcategoryImagePreview");
});
