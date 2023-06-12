<?php

return [
    BACHELOR_APPLICANT_ID => [
        'label' => 'NAK bachelor applicant ID',
        'groupName' => 'nak_bachelor',
        'description' => 'Applicant ID of application portal',
        'type' => 'number',
        'filedType' => 'number',
        'options' => [],
    ],
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
    BACHELOR_DESIRED_BEGINNING => [
        'label' => 'Desired Beginning',
        'groupName' => 'nak_bachelor',
        'description' => 'A contact\'s desired beginning',
        'type' => 'string',
        'fieldType' => 'text',
        'options' => [],
    ],
    BACHELOR_STUDY_COURSES => [
        'label' => 'Study Courses',
        'groupName' => 'nak_bachelor',
        'description' => 'A contact\'s study courses',
        'type' => 'enumeration',
        'fieldType' => 'checkbox',
        'options' => [
            [
                'label' => '',
                'value' => '',
            ],
        ],
    ],
    BACHELOR_REGISTRATION_SUBMITTED => [
        'label' => 'Registration submitted',
        'groupName' => 'nak_bachelor',
        'description' => 'NAK contact\'s registration submitted',
        'type' => 'datetime',
        'fieldType' => 'date',
        'options' => [],
    ],
    BACHELOR_PROFILE_INFORMATION_COMPLETED => [
        'label' => 'Profile information completed',
        'groupName' => 'nak_bachelor',
        'description' => 'NAK contact\'s application accepted',
        'type' => 'datetime',
        'fieldType' => 'date',
        'options' => [],
    ],
    BACHELOR_TEST_TAKEN => [
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
    BACHELOR_TEST_PASSED => [
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
    BACHELOR_APPLIED_ON_MARKETPLACE => [
        'label' => 'Applied on marketpalce',
        'groupName' => 'nak_bachelor',
        'description' => 'NAK contact\'s applied on marketpalce',
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
    BACHELOR_CONSENT_TO_COMPANY_PORTAL_BULLETIN_BOARD => [
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
    BACHELOR_APPROVED_BY_COMPANY_FOR_ENROLMENT => [
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
    BACHELOR_REJECTED_BY_APPLICANT => [
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
