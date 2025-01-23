<script type="text/javascript">
  function showLoader(){
    $(document).find('#pageloader').css('display', 'flex');
    return true;
  }
  function hideLoader(){
    $(document).find('#pageloader').css('display', 'none');   
    return true;   
  }
  function setStep(){
      goToStep("{{ $goToStep }}");    
      return true;
  }
  showLoader();
  $(document).ready(function(){
      var form = $("#submission-step-form");
      var currentStep = 0;
      var stepperDirection = "forward";
      var isMoved = false;

      setTimeout(function(){
        $('#steps-nav').css('display','none');
        $('#submission-process-content').css('display','block');
        var btnFinish = $('<button type="submit" id="finishBtn"></button>').text('Deliver & Complete Process')
                        .addClass('btn btn-info sw-btn-group-next finish-btn d-none');

        var btnSaveSkip = $('<button type="submit" id="saveBtn"></button>').text('Approve & Move To Next Stage')
                          .addClass('btn btn-info sw-btn-group-next btn_save_skip');

        $('#smartwizard').smartWizard({
            theme: 'default',
            showStepURLhash: false,
            useURLhash: false,
            keyNavigation: false,
            // enableAllSteps: true,
            toolbarSettings: {
              toolbarPosition: 'bottom', // none, top, bottom, both
              toolbarButtonPosition: 'right', // left, right, center
              showNextButton: false, // show/hide a Next button
              showPreviousButton: true, // show/hide a Previous button
              toolbarExtraButtons: [btnSaveSkip,btnFinish] // Extra buttons to show on toolbar, array of jQuery input/buttons elements            
            },
        });        
        hideLoader();
        setStep();
      }, 1000);

      $(document).on("keydown", ":input:not(textarea)", function(event) { 
          return event.key != "Enter";
      });

      $.validator.addMethod('lessThanEqual', function(value, element, param) {
          return this.optional(element) || parseFloat(value) <= parseFloat($(param).val());
      });

      form.validate({
        errorPlacement: function(label, element) {
            label.addClass('help-block validation-error d-block mb-0');
            if ($(element).hasClass('select2')) {
              label.insertAfter(element.siblings('.select2'));
            } else if ($(element).is('select')) {
              element.removeClass('error');
              label.insertAfter(element);
            } else if ($(element).attr('type') === 'radio' || $(element).attr('type') === 'checkbox') {
              label.insertAfter(element.parents('.payment-transactions'));
            } else if ($(element).attr('type') === 'file') {
              label.insertAfter(element.parents('.dropify-wrapper'));
            } else {
              label.insertAfter(element);
            }
        },
        rules: {
            payment_status: {
                required: true,
            },
            bill_amount: {
                required: true,
            },
            paid_amount: {
              required: function(element){
                  return $("#payment_status").val() != "not_paid";
              },              
              lessThanEqual: "#bill_amount"
            },
            o_level_certificate_source: {
                required: true,
            },                
            o_level_certificate_status: {
                required: true,
            },
            degree_certificate_source: {
                required: true,
            },                
            degree_certificate_status: {
                required: true,
            },
            academic_transcript_source: {
                required: true,
            },                
            academic_transcript_status: {
                required: true,
            },
            evaluation_template_id: {
                required: true,
            },                
            "mappings[]": {
                required: false,
            },            
            update_o_level_certificate_source: {
                required: true,
            },
            update_o_level_certificate_status: {
                required: true,
            },
            o_level_verification_status: {
                required: true,
            },
            update_degree_certificate_source: {
                required: true,
            },
            update_degree_certificate_status: {
                required: true,
            },
            degree_verification_status: {
                required: true,
            },
            update_transcript_source: {
                required: true,
            },
            update_transcript_status: {
                required: true,
            },
            transcript_verification_status: {
                required: true,
            },
            nigeria: {
                required: true,
            },
            degree: {
                required: true,
            },
            comparability: {
                required: true,
            },
            undergraduate_admission: {
                required: true,
            },
            admission_notes_1: {
                required: true,
            },
            admission_notes_2: {
                required: false,
            },
            summary_notes_1: {
                required: true,
            },
            summary_notes_2: {
                required: false,
            },
            summary_notes_3: {
                required: false,
            },            
            "recipent[]": {
                required: true,
            },
        },
        messages: {
            payment_status: {
                required: "Please select payment status",
            },
            bill_amount: {
                required: 'Please Enter bill amount',
            },
            paid_amount: {
              required: 'Paid amount is required if payment status is not fully paid',
              lessThanEqual: 'Paid amount should be less than or equal to bill amount',
            },
            o_level_certificate_source: {
                required: 'Please select o level certificate source',
            },                
            o_level_certificate_status: {
                required: 'Please select o level certificate status',
            },
            degree_certificate_source: {
                required: 'Please select degree certificate source',
            },                
            degree_certificate_status: {
                required: 'Please select degree certificate status',
            },
            academic_transcript_source: {
                required: 'Please select academic transcript source',
            },                
            academic_transcript_status: {
                required: 'Please select academic transcript status',
            },
            evaluation_template_id: {
                required: 'Please select evaluation template',
            },            
            o_level_certificate: {
                required: 'Please select o level certificate',
            },
            degree_certificate: {
                required: 'Please select degree certificate',
            },
            academic_transcript: {
                required: 'Please select academic transcript',
            },
            nigeria: {
                required: 'Please select nigeria',
            },
            degree: {
                required: 'Please select degree',
            },
            comparability: {
                required: 'Please select comparability',
            },
            undergraduate_admission: {
                required: 'Please enter undergraduate admission',
            },
            admission_notes_1: {
                required: 'Please enter admission notes 1',
            },
            admission_notes_2: {
                required: 'Please enter admission notes 2',
            },
            summary_notes_1: {
                required: 'Please enter summary notes 1',
            },
            summary_notes_2: {
                required: 'Please enter summary notes 2',
            },
            summary_notes_3: {
                required: 'Please enter summary notes 3',
            },            
        }
    });

    $("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {  
      stepperDirection = stepDirection;  
      if (stepDirection === 'forward') { 
        // form.validate().settings.ignore = ":disabled,:hidden";              
        if (!form.valid()) {
            hideLoader();
            return false;
        }
      }
    });

    $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
      if(stepNumber == 7){
        $('#finishBtn').removeClass('d-none');
        @if($holderSubmission && $holderSubmission->is_all_document_submitted)
          $('#finishBtn').removeClass('disabled-btn');
        @else
          $('#finishBtn').addClass('disabled-btn');
        @endif
        $('#saveBtn').addClass('d-none');
      }else{
        $('#finishBtn').addClass('disabled-btn');
        $('#finishBtn').addClass('d-none');
        $('#saveBtn').removeClass('d-none');
      }
      if(stepNumber == 3){ // Stage 4
        $('.update_o_level_certificate_source').val($('#o_level_certificate_source').val()).trigger('change');
        $('.update_degree_certificate_source').val($('#degree_certificate_source').val()).trigger('change');
        $('.update_transcript_source').val($('#academic_transcript_source').val()).trigger('change');
      }
      if (stepperDirection === 'backward') { 
        if(stepNumber == 0){
          if($('#payment_status').val() == "not_paid"){
            $('#paid_amount').val(0.00);
          }
        }
        if (!form.valid()) {
            hideLoader();
            return false;
        }else{
          currentStep = parseInt(stepNumber)+1;
          isMoved = true;
          form.submit();
          return true;
        }
      }else{    
        isMoved = false;    
        currentStep =  parseInt(stepNumber)+1;
      }
    }); 

    $('#payment_status').on('change',function(){
      if($(this).val() == 'not_paid'){
        $('#paid_amount_box').css('display','none');
        $('#paid_amount').attr('required',false);
      }else{
        $('#paid_amount_box').css('display','block');
        $('#paid_amount').attr('required',true);
      }
    });

    $(document).on('change','#evaluation_template_id', function(){
        if($(this).val() != ''){
            getTemplateMappings($(this).val());
        }else{
            $("#template-mapping-content").html('');
        }
    });

    $(document).on('click','#generate-evaluation-pdf', function(event){
      event.preventDefault();
      var thisBtn = $(this);
      $.ajax({
          type: "GET",
          dataType: 'json',
          url: "{{ route('admin.processingSubmissions.generateEvaluationReport',$holderSubmission) }}",
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          beforeSend: function(){                
              showLoader(); // Show loader container
          },
          success: function(response) {            
            if(response.status){
              thisBtn.text("Regenerate");
              $('#view-evaluation-report').attr('href',response.pdf_url).removeClass('disabled');
              toastr.success(response.message, 'Success!');
            }else{
              toastr.error(response.message, 'Error!');
            }         
          },
          error: function(response) {
            toastr.error(response.responseJSON.message,'Error');              
          },
          complete: function(response) {
            hideLoader(); // hide loader container
            enableMergeReportBtn();
          }
      });
    });

    $(document).on('click','#merge-pdf', function(event){
      event.preventDefault();
      var thisBtn = $(this);
      $.ajax({
          type: "GET",
          dataType: 'json',
          url: "{{ route('admin.processingSubmissions.mergeReport',$holderSubmission) }}",
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          beforeSend: function(){                
              showLoader(); // Show loader container
          },
          success: function(response) {            
            if(response.status){
              thisBtn.text("Regenerate");
              $('#view-merged-report').attr('href',response.pdf_url).removeClass('disabled');
              $('#preview-merge-report').attr('src',response.pdf_url);
              $('#download-merge-report').attr('href',response.pdf_url);
              toastr.success(response.message, 'Success!');
            }else{
              toastr.error(response.message, 'Error!');
            }         
          },
          error: function(response) {
            toastr.error(response.responseJSON.message,'Error');              
          },
          complete: function(response) {
              hideLoader(); // hide loader container
          }
      });
    });

    $(document).on('click','.generate-extraction-pdf', function(event){
      event.preventDefault();
      var thisBtn = $(this);

      if(currentStep == 3 && !form.valid()){
        hideLoader();
        return false;
      }
      var formData = form.serializeArray();
      formData.push(
        {
          name: "current_step",
          value: currentStep
        },
        {
          name: "is_moved",
          value: isMoved
        }
      );
      $.ajax({
          type: "POST",
          dataType: 'json',
          url: "{{ route('admin.processingSubmissions.generateExtractionReport',$holderSubmission) }}",
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: formData,
          beforeSend: function(){                
              showLoader(); // Show loader container
          },
          success: function(response) {
            if(response.status){
              toastr.success(response.message, 'Success!');
              if(currentStep == 3 || currentStep == 5){
                if(currentStep == 3){
                  thisBtn.text("Regenerate and Preview Report");
                }
                setTimeout(function(){
                  window.open(response.pdf_url, "_blank").focus();
                }, 1000);
              }else{
                thisBtn.text("Regenerate");
                $('#view-extraction-report').attr('href',response.pdf_url).removeClass('disabled');
              }
            }else{
              toastr.error(response.message, 'Error!');
            }              
          },
          error: function(response) {
            toastr.error(response.responseJSON.message,'Error');              
          },
          complete: function(response) {
              hideLoader(); // hide loader container
              enableMergeReportBtn();
          }
      });
    });    

    $("#submission-step-form").on("submit", async function(e){
      e.preventDefault();
      toastr.clear();
      $('.validation-error').remove();
      if (!form.valid()) {
        hideLoader();
        return false;
      } 
      if(currentStep == 8 && $('#finishBtn').hasClass("disabled-btn")){
        toastr.warning("{{ trans('messages.documents_required_message') }}", 'Info!');
        return false;
      }
      
        
      var formData = $(this).serializeArray();
      formData.push(
        {
          name: "current_step",
          value: currentStep
        },
        {
          name: "is_moved",
          value: isMoved
        }
      );  

      await $.ajax({
          type: "POST",
          dataType: 'json',
          url: "{{ route('admin.processingSubmissions.updateSteps',$holderSubmission) }}",
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: formData,
          // async: false, 
          beforeSend: function(){                
              showLoader(); // Show loader container
          },         
          success: function(response) {
            if(response.status){
              if(response.toastr_status == "success"){
                toastr.success(response.message, 'Success!');
              }else if(response.toastr_status == "info"){
                toastr.warning(response.message, 'Info!');
              }
              if(isMoved || isMoved == "true"){
                isMoved = false;
                goToStep(parseInt(response.next_step)-1); 
              }else if(currentStep != 8){
                goToStep(response.next_step);              
              }else{
                fireSuccessSwal('Process Complete!','Submission process completed successfully!');
                setTimeout(function(){
                  window.location.href = "{{ route('admin.processing-submissions.index') }}";
                }, 2000);
              }
            }else{
              if(response.toastr_status == "info"){
                toastr.warning(response.message, 'Info!');
              }else{
                toastr.error(response.message, 'Error!');                
              }
            }            
          },
          error: function(response) {
            let errorMessages = '';
            $.each(response.responseJSON.errors, function(field_name, error) {
              console.log(field_name.indexOf('.') > -1);
              if (field_name.indexOf('.') > -1)
              {
                var validate_field_name = field_name.replace(/([.])+/g, '_');
                var element = $('.'+validate_field_name);
                if ($(element).is('select') && $(element).hasClass('select2')) {
                    $('<span class="help-block text-danger validation-error">' + error + '</span>').insertAfter(element.siblings('.select2'));
                }else{
                    $('<span class="help-block text-danger validation-error">' + error + '</span>').insertAfter(element);
                }
              }else{
                $('<span class="help-block text-danger validation-error">' + error + '</span>').insertAfter($('.'+field_name));
              }
              $.each(error, function(i, message) {
                errorMessages += '<li>' + message + '</li>';
              });
            })
            $("#saveButton").prop('disabled', false);
            toastr.error(errorMessages, 'Error');              
          },
          complete: function(response) {
            hideLoader(); // hide loader container
          }
      });
    });

    $(document).on('click' , '.del_recipent' , function(event){
      event.preventDefault();
      if($('.recipent-row').length <=1 ){
        toastr.warning('You cannot delete this recipent. Need to send report to atlease one recipent!','Warning!');
      }else{          
        var dataId = $(this).data("recipent");
        $(document).find("."+dataId).remove();
      }
    })

    $(document).on('click' , '.delete_record' , function(event){
      event.preventDefault();
      if($('.recipent-row').length <=1 ){
        toastr.warning('You cannot delete this recipent. Need to send report to atlease one recipent!','Warning!');
      }else{  
        var dataRow = $(this).data("recipent");
        var url = $(this).data("url");
        Swal.fire({
            title: "Are you sure?",
            text: "You want to delete this recipent!",
            icon: "warning",
            showDenyButton: true,  
            showCancelButton: true,  
            confirmButtonText: `Yes, I am sure`,  
            denyButtonText: `'No, cancel it!`,
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              type: "GET",
              dataType: 'json',
              url: url,              
              beforeSend: function(){                
                  showLoader(); // Show loader container
              },
              success: function(response) {            
                if(response.status){
                  $(document).find("."+dataRow).remove();
                  toastr.success(response.message, 'Success!');
                }else{
                  toastr.error(response.message, 'Error!');
                }         
              },
              error: function(response) {
                toastr.error(errorMessages, response.responseJSON.message);              
              },
              complete: function(response) {
                  hideLoader(); // hide loader container
              }
            });
          }
        });        
      }
    })

  });
  
  function addRecipentBox(){
    var counter = $('.add_row').attr('data-counter');
    counter = parseInt(counter)+1;
    console.log(counter);
    $('.add_row').attr('data-counter',counter);
    var rowToCopy =  $(document).find('.repeatable-recipent').first();
    var rowNumber = rowToCopy.data('row');
    rowToCopy.clone().attr('data-row',counter).removeClass('recipent-'+rowNumber)
      .find(".validation-error").remove().end()
      .find(".recipent_id").remove().end()
      .find(".recipent_name").attr('name',"recipent["+counter+"][name]").attr('id',"recipent_name_"+counter).val("").end()
      .find(".recipent_email").attr('name',"recipent["+counter+"][email]").attr('id',"recipent_email_"+counter).val("").end()
      .find(".del-btn").removeClass('delete_record').addClass('del_recipent').removeAttr('data-url').attr('data-recipent',"recipent-"+counter).end()
      .removeClass('recipent-0')
      .addClass("recipent-"+counter)
      .appendTo($(".recipent-details"));

      
      $('#recipent_name_'+counter).siblings('.help-block').removeClass('recipent_name_'+rowNumber).addClass('recipent_name_'+counter);
      $('#recipent_email_'+counter).siblings('.help-block').removeClass('recipent_email_'+rowNumber).addClass('recipent_email_'+counter);
  }

  function enableMergeReportBtn(){
    if(!$('#view-evaluation-report').hasClass('disabled') && !$('#view-extraction-report').hasClass('disabled')){
      $('#merge-pdf').attr('disabled',false);
    }else{
      $('#merge-pdf').attr('disabled',true);
    }
  }

  // get Template Mappings
  function getTemplateMappings(template_id, extract_transcript_id=''){
      showLoader();
      $.ajax({
          type: "POST",
          dataType:'json',
          url: "{{ route('admin.evaluation-template-mappings.getTemplateMappings') }}",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
            evaluation_template_id : template_id,
            submission_id : "{{ (isset($holderSubmission) && $holderSubmission->stage3) ? $holderSubmission->id : '' }}",
          },
          success: function(response){
              $('#template-mapping-content').html(response.html);
              if(response.total_records <= 0){
                $('#generate-extraction-pdf-step3').attr('disabled',true);
              }else{
                $('#generate-extraction-pdf-step3').removeAttr('disabled');
              }
          },
          error:function (response){
              $.each(response.responseJSON.errors, function (key, item) {
                  $('.error_'+key).html(item);
                  $('.error_'+key).show();
              });
          },
          complete:function (response){
            hideLoader();
          }
      });
  }
  
  function goToStep(step){
    $('#smartwizard').smartWizard("goToStep", step);
  }

</script>