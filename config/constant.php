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
            2   => 'No',
        ],
        'field_types' => [
            1   => 'Text',
            2   => 'Combo',
            3   => 'Memo',
            4   => 'Date',
        ],

    ],
];
