<?php

return [
    'email' => [
        'label' => 'Email',
        'groupName' => 'contactinformation',
        'description' => 'A contact\'s email address',
        'type' => 'string',
        'fieldType' => 'text',
        'options' => [],
    ],
    'firstname' => [
        'label' => 'First Name',
        'description' => 'A contact\'s first name',
        'groupName' => 'contactinformation',
        'type' => 'string',
        'fieldType' => 'text',
        'options' => [],
    ],
    'lastname' => [
        'label' => 'Last Name',
        'description' => 'A contact\'s last name',
        'groupName' => 'contactinformation',
        'type' => 'string',
        'fieldType' => 'text',
        'options' => [],
    ],
    'phone' => [
        'label' => 'Phone Number',
        'groupName' => 'contactinformation',
        'description' => 'A contact\'s primary phone number',
        'type' => 'string',
        'fieldType' => 'phonenumber',
        'options' => [],
    ],
    'bachelor_desired_beginning' => [
        'label' => 'Desired Beginning',
        'groupName' => 'nak_bachelor',
        'description' => 'A contact\'s desired beginning',
        'type' => 'string',
        'fieldType' => 'text',
        'options' => [],
    ],
    'bachelor_master_study_course' => [
        'label' => 'Master Study Course',
        'groupName' => 'nak_bachelor',
        'description' => 'A contact\'s study course',
        'type' => 'enumeration',
        'fieldType' => 'checkbox',
        'options' => [
            [
                'label' => '',
                'value' => '',
            ],
        ],
    ],
    'bachelor_registration_submitted' => [
        'label' => 'Registration submitted',
        'groupName' => 'nak_bachelor',
        'description' => 'NAK contact\'s registration submitted',
        'type' => 'datetime',
        'fieldType' => 'date',
        'options' => [],
    ],
    'bachelor_profile_information_completed' => [
        'label' => 'Profile information completed',
        'groupName' => 'nak_bachelor',
        'description' => 'NAK contact\'s application accepted',
        'type' => 'datetime',
        'fieldType' => 'date',
        'options' => [],
    ],
    'bachelor_test_taken' => [
        'label' => 'Test taken',
        'groupName' => 'nak_bachelor',
        'description' => 'NAK contact\'s test taken',
        'type' => 'enumeration',
        'fieldType' => 'booleancheckbox',
        'options' => [
            [
                'label' => 'Yes',
                'value' => true,
            ],
            [
                'label' => 'No',
                'value' => false,
            ],
        ],
    ],
    'bachelor_test_passed' => [
        'label' => 'Test passed',
        'groupName' => 'nak_bachelor',
        'description' => 'NAK contact\'s test passed',
        'type' => 'enumeration',
        'fieldType' => 'booleancheckbox',
        'options' => [
            [
                'label' => 'Yes',
                'value' => true,
            ],
            [
                'label' => 'No',
                'value' => false,
            ],
        ],
    ],
    'bachelor_personal_data_completed' => [
        'label' => 'Personal data completed',
        'groupName' => 'nak_bachelor',
        'description' => 'NAK contact\'s personal data completed',
        'type' => 'enumeration',
        'fieldType' => 'booleancheckbox',
        'options' => [
            [
                'label' => 'Yes',
                'value' => true,
            ],
            [
                'label' => 'No',
                'value' => false,
            ],
        ],
    ],
    'bachelor_consent_to_company_portal_bulletin_board' => [
        'label' => 'Consent to company portal bulletin board',
        'groupName' => 'nak_bachelor',
        'description' => 'NAK contact\'s consent to company portal bulletin board',
        'type' => 'enumeration',
        'fieldType' => 'booleancheckbox',
        'options' => [
            [
                'label' => 'Yes',
                'value' => true,
            ],
            [
                'label' => 'No',
                'value' => false,
            ],
        ],
    ],
    'bachelor_approved_by_company_for_enrolment' => [
        'label' => 'Approved by company for enrolment',
        'groupName' => 'nak_bachelor',
        'description' => 'NAK contact\'s approved by company for enrolment',
        'type' => 'enumeration',
        'fieldType' => 'booleancheckbox',
        'options' => [
            [
                'label' => 'Yes',
                'value' => true,
            ],
            [
                'label' => 'No',
                'value' => false,
            ],
        ],
    ],
    'bachelor_rejected_by_applicant' => [
        'label' => 'Rejected by applicant',
        'groupName' => 'nak_bachelor',
        'description' => 'A contact\'s rejected application',
        'type' => 'enumeration',
        'fieldType' => 'booleancheckbox',
        'options' => [
            [
                'label' => 'Yes',
                'value' => true,
            ],
            [
                'label' => 'No',
                'value' => false,
            ],
        ],
    ],
];
