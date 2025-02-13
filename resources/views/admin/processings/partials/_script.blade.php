<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        toggleVerificationFields();

        $('#status').change(function() {
            toggleVerificationFields();
        });

        $.validator.addMethod("outcomeEvidenceRequired", function(value, element) {
            return $('#status').val() !== 'Complete' || (this.optional(element) || value.length > 0);
        }, "Outcome evidence is required when the status is Complete.");

        $("#processing-form").validate({
            rules: {
                order_id: {
                    required: true
                },
                status: {
                    required: true
                },
                verification_outcome: {
                    required: function() {
                        return $('#status').val() === 'Complete'; 
                    }
                },
                outcome_evidence: {
                    required: function() {
                        return $('#status').val() === 'Complete'; 
                    },
                    outcomeEvidenceRequired: true, 
                    extension: "pdf" 
                }
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
            }
        });

        function toggleVerificationFields() {
            if ($('#status').val() === 'Complete') {
                $('#verification_outcome').closest('.form-group').show();
                $('#outcome_evidence').closest('.form-group').show();
            } else {
                $('#verification_outcome').closest('.form-group').hide();
                $('#outcome_evidence').closest('.form-group').hide();
            }
        }
    });
</script>
