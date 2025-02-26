<?php

return [
    'holderSubmissionStages' => [
        'titles'    => [
            'stage_0'   => 'Submitted',
            'stage_1'   => 'Bill and Verify Payment',
            'stage_2'   => 'Obtain Documentation',
            'stage_3'   => 'Extract Transcript',
            'stage_4'   => 'Update Verification',
            'stage_5'   => 'Perform Evaluation',
            'stage_6'   => 'Prepare Report',
            'stage_7'   => 'Validate Report',
            'stage_8'   => 'Deliver Report',
            'stage_9'   => 'Completed',
        ],
        'heading_titles'    => [
            'stage_0'   => 'Submitted',
            'stage_1'   => 'Stage 1 - Bill & Verify Payment',
            'stage_2'   => 'Stage 2 - Upload Documentation',
            'stage_3'   => 'Stage 3 - Extract Transcript',
            'stage_4'   => 'Stage 4 - Update Verification',
            'stage_5'   => 'Stage 5 - Perform Evaluation',
            'stage_6'   => 'Stage 6 - Prepare Report',
            'stage_7'   => 'Stage 7 - Validate Report',
            'stage_8'   => 'Stage 8 - Deliver Report',
        ],
        'routes'    => [
            'stage_0'   => 'Submitted',
            'stage_1'   => 'Bill and Verify Payment',
            'stage_2'   => 'Submitted',
            'stage_3'   => 'Submitted',
            'stage_4'   => 'Submitted',
            'stage_5'   => 'Submitted',
            'stage_6'   => 'Submitted',
            'stage_7'   => 'Submitted',
            'stage_8'   => 'Submitted',
        ],
        'requestVerification'   => [			
            'source'            => [
                'holder_submitted'     => 'Holder Submitted',
                'issuer_submitted'     => 'Issuer Submitted',
            ],
            'status'            => [
                'requested'     => 'Requested',
                'pending'       => 'Pending',
            ],
        ],
        'updateVerification'    => [
            'status'            => [
                'authentic'     => 'Authentic',
                'not_authentic' => 'Not Authentic',
                'undetermined'  => 'Undetermined',
            ],
        ],
        'performEvaluation'     => [
			'degree_certificate_status'         => [
                'two_years_of_degree_course' 	=> 'Two Years of Degree Course',
				'three_years_of_degree_course' 	=> 'Three Years of Degree Course',
				'four_years_of_degree_course' 	=> 'Four Years of Degree Course',
				'five_years_of_degree_course' 	=> 'Five Years of Degree Course',
				'six_years_of_degree_course' 	=> 'Six Years of Degree Course',
            ],
            'status'            => [
                'full_equivalence'      => 'Full Equivalence',
                'partial_equivalence'   => 'Partial Equivalence',
                'no_equivalence'        => 'No Equivalence',
            ],
        ],
        'status'    => [
            'yes'   => 'Yes',
            'no'    => 'No',
        ],
    ],
    
    'submission_receiver_email_address' => 'crm@etx.ng',
    'submission_receiver_name'          => 'Admin',

    'holder_submission_documents'    => [
        'o_level_certificate'       => 'O Level Certificate',
        'degree_certificate'        => 'Degree Certificate',
        'academic_transcripts'      => 'Academic Transcripts',
        'receiver_letter'      => 'Receiver Letter',
        'ministry_of_education_letter'      => 'Ministry of Education Letter',
        'birth_certificate'      => 'Birth Certificate',
    ],
    'enums' => [
        'status' => [
            '1'        => 'Active',
            '0'      => 'Inactive',          
        ],
        'client_type' => [
            'individual' => 'Individual',
            'organization' => 'Organization',
        ],
        'payment_status' => [
            '1' => 'Successful',
            '0' => 'Failed',
        ],
        'processing_status' => [
            'not_started' => 'Not Started',
            'processing' => 'Processing',
            'complete' => 'Complete',
            'cancelled' => 'Cancelled',
        ],
        'verification_outcome' => [
            'passed' => 'Passed',
            'failed' => 'Failed',
        ],
        'issuerType'       => [
            'private'       => 'Private University',
            'public'        => 'Public University',
        ],
        'recognitionStatus'=> [
            'yes'           => 'Yes',
            'no'            => 'No',
            'undetermined'  => 'Undetermined',
        ],
        'accreditationStatus' => [
            'yes'           => 'Yes',
            'no'            => 'No',
            'expired'       => 'Expired',
            'undetermined'  => 'Undetermined',
        ],
        'courseType' => [
            'bachelor'      => 'Bachelor’s Degree Course',
            'diploma'       => 'Diploma Degree Course',
            'master'        => 'Masters Degree Course',
        ],
        'type' => [
            '1'   => 'Issuer',
            '2'   => 'Receiver',
        ],
        'page_length' => [
            'lengthMenu' => [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000]],
        ],
        'subjects' => [
            1   => 'Individual',
            2   => 'Organization',
        ],
        'input_details' => [
            1   => 'Yes',
            0   => 'No',
        ],
        'field_types' => [
            1   => 'Text',
            2   => 'Combo',
            3   => 'Memo',
            4   => 'Date',
        ],
        'verification_duration_types' => [
            "days"   => 'Day',
            "months"   => 'Month',
            "years"   => 'Year',
        ],
        'marital_status' => [
            'married' => 'Married',
            'single' => 'Single',
            'other' => 'Other',
        ],
        'gender' => [
            'male' => 'Male',
            'female' => 'Female',
            'other' => 'Other',
        ],
        'input_details_fields' => [ 
            'subject_name' => [
                'field_name' => "subject_name",
                'label' => "Name of Subject",
                'inp_type' => "text",
                'options' => [],
            ],
            'copy_of_document_to_verify' => [
                'field_name' => "copy_of_document_to_verify",
                'label' => "Copy of Document to Verify",
                'inp_type' => "file",
                'options' => [],
            ],
            'reason_for_request' => [
                'field_name' => "reason_for_request",
                'label' => "Reason for Request",
                'inp_type' => "select",
                'options' => [
                    'admission' => "Admission", 
                    'employment' => "Employment", 
                    'other' => "Other", 
                ]
            ],
            'subject_consent_requirement' => [
                'field_name' => "subject_consent_requirement",
                'label' => "Subject Consent Requirement",
                'inp_type' => "file",
                'options' => [],
            ],
            'name_of_reference_provider' => [
                'field_name' => "name_of_reference_provider",
                'label' => "Name of Reference Provider",
                'inp_type' => "text",
            ],
            'address_information' => [
                'field_name' => "address_information",
                'label' => "Address Information",
                'inp_type' => "textarea",
            ],
            'location' => [
                'field_name' => "location",
                'label' => "Location",
                'inp_type' => "select", // countries
                'options' => [], 
            ],
            'gender' => [
                'field_name' => "gender",
                'label' => "Gender",
                'inp_type' => "select",
                'options' => [
                    'male' => "Male", 
                    'female' => "Female", 
                    'other' => "Other", 
                ]
            ],
            'marital_status' => [
                'field_name' => "marital_status",
                'label' => "Marital Status",
                'inp_type' => "select",
                'options' => [
                    'single' => "Single", 
                    'married' => "Married", 
                    'other' => "Other", 
                ]
            ],
            'registration_number' => [
                'field_name' => "registration_number",
                'label' => "Registration Number",
                'inp_type' => "text",
            ],
            'subject_name' => [
                'field_name' => "subject_name",
                'label' => "Name of Subject",
                'inp_type' => "text",
            ],
        ]

    ],
];
