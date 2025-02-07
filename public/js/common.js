
// function submitForm(form) {
//     console.log(form);
//     var formData = new FormData(form);
//     var url = $(form).attr('action');
//     var method = $(form).attr('method');
//     $.ajax({
//         url: url,
//         type: method,
//         data: formData,
//         processData: false,
//         contentType: false,
//         beforeSend: function () {
//             $('button[type="submit"], input[type="submit"]').prop('disabled', true);
//             console.log("Request is being sent...");
//         },
//         success: function (response) {
//             console.log(response);
//             if (response.status) {
//                 console.log(response)
//                 Swal.fire({
//                     title: 'Success',
//                     text: response.message,
//                     icon: 'success',
//                     confirmButtonText: 'OK',
//                 }).then((result) => {
//                     if (result.isConfirmed && response.redirect_url) {
//                         console.log('Redirection to :',response.redirect_url);
//                         window.location.href = response.redirect_url;
//                     }
//                 });
//             } else {
//                 Swal.fire({
//                     title: 'Error',
//                     text: response.message || 'Something went wrong!',
//                     icon: 'error',
//                     confirmButtonText: 'OK',
//                 });
//             }
//         },
//         error: function (xhr) {
//             console.log('ajax error:', xhr);
//             $('button[type="submit"], input[type="submit"]').prop('disabled', false);

//             if (xhr.status === 422) {
//                 var errors = xhr.responseJSON.errors;
//                 $.each(errors, function (key, value) {
//                     let input = $('[name="' + key + '"]');
//                     input.addClass('is-invalid');
//                     input.closest('.form-group').find('.invalid-feedback').remove();
//                     input.after('<span class="invalid-feedback">' + value[0] + '</span>');
//                 });
//             } else {
//                 Swal.fire({
//                     title: 'Error',
//                     text: xhr.responseJSON.message || 'An unexpected error occurred!',
//                     icon: 'error',
//                     confirmButtonText: 'OK',
//                 });
//             }
//         },
//         complete: function () {
//             $('button[type="submit"], input[type="submit"]').prop('disabled', false);
//             console.log("Request completed.");
//         }
//     });
// }

// function previewImage(inputId, previewId) {
//     let fileInput = $('#' + inputId);
//     let previewImg = $('#' + previewId);
//     let oldImage = previewImg.attr('src');

//     fileInput.on('change', function(event) {
//         let file = event.target.files[0];

//         if (file) {
//             let reader = new FileReader();
//             reader.onload = function(e) {
//                 previewImg.attr('src', e.target.result);
//             };
//             reader.readAsDataURL(file);
//         } else {
//             previewImg.attr('src', oldImage);
//         }
//     });
// }
// window.previewImage = previewImage;


function submitForm(form) {
    console.log("Form submission started:", form);

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
            console.log("Sending request to:", url);
        },
        success: function (response) {
            console.log("Success response:", response);

            if (response.status) {
                Swal.fire({
                    title: 'Success',
                    text: response.message || 'Operation successful!',
                    icon: 'success',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    if (result.isConfirmed && response.redirect_url) {
                        console.log("Redirecting to:", response.redirect_url);
                        window.location.href = response.redirect_url;
                    }
                });
            } else {
                Swal.fire({
                    title: 'Error',
                    text: response.message || 'Something went wrong!',
                    icon: 'error',
                    confirmButtonText: 'OK',
                });
            }
        },
        error: function (xhr) {
            console.log("AJAX error:", xhr);

            $('button[type="submit"], input[type="submit"]').prop('disabled', false);

            if (xhr.status === 422) {
                var errors = xhr.responseJSON.errors;
                
                // Clear previous errors
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();

                // Show new validation errors
                $.each(errors, function (key, messages) {
                    let input = $('[name="' + key + '"]');
                    input.addClass('is-invalid');

                    let errorMessage = Array.isArray(messages) ? messages[0] : messages;
                    input.after('<span class="invalid-feedback d-block">' + errorMessage + '</span>');
                });

                Swal.fire({
                    title: 'Validation Error',
                    text: 'Please correct the errors in the form.',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                });
            } else {
                Swal.fire({
                    title: 'Error',
                    text: xhr.responseJSON?.message || 'An unexpected error occurred!',
                    icon: 'error',
                    confirmButtonText: 'OK',
                });
            }
        },
        complete: function () {
            $('button[type="submit"], input[type="submit"]').prop('disabled', false);
            console.log("Request completed.");
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
            if (!file.type.startsWith('image/')) {
                Swal.fire({
                    title: 'Invalid File',
                    text: 'Please upload a valid image file.',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                });
                previewImg.attr('src', oldImage); 
                return;
            }

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

window.previewImage = previewImage;