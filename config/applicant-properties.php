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
    'desired_beginning' => [
        'label' => 'Desired Beginning',
        'groupName' => 'contactinformation',
        'description' => 'A contact\'s desired beginning',
        'type' => 'string',
        'fieldType' => 'text',
        'options' => [],
    ],
    'master_study_course' => [
        'label' => 'Master Study Course',
        'groupName' => 'contactinformation',
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
    'registration_submitted' => [
        'label' => 'Registration submitted',
        'groupName' => 'contactinformation',
        'description' => 'NAK contact\'s registration submitted',
        'type' => 'datetime',
        'fieldType' => 'date',
        'options' => [],
    ],
    'profile_information_completed' => [
        'label' => 'Profile information completed',
        'groupName' => 'contactinformation',
        'description' => 'NAK contact\'s application accepted',
        'type' => 'datetime',
        'fieldType' => 'date',
        'options' => [],
    ],
    'test_taken' => [
        'label' => 'Test taken',
        'groupName' => 'contactinformation',
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
    'test_passed' => [
        'label' => 'Test passed',
        'groupName' => 'contactinformation',
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
    'personal_data_completed' => [
        'label' => 'Personal data completed',
        'groupName' => 'contactinformation',
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
    'consent_to_company_portal_bulletin_board' => [
        'label' => 'Consent to company portal bulletin board',
        'groupName' => 'contactinformation',
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
    'approved_by_company_for_enrolment' => [
        'label' => 'Approved by company for enrolment',
        'groupName' => 'contactinformation',
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
    'rejected_by_applicant' => [
        'label' => 'Rejected by applicant',
        'groupName' => 'contactinformation',
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
    'rejected_by_nak' => [
        'label' => 'Rejected by NAK',
        'groupName' => 'contactinformation',
        'description' => 'A contact\'s application rejected by NAK',
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
