<?php

return [
    'email'                               => [
        'label'       => 'Email',
        'groupName'   => 'contactinformation',
        'description' => 'A contact\'s email address',
        'type'        => 'string',
        'fieldType'   => 'text',
        'options'     => [],
    ],
    'firstname'                           => [
        'label'       => 'First Name',
        'description' => 'A contact\'s first name',
        'groupName'   => 'contactinformation',
        'type'        => 'string',
        'fieldType'   => 'text',
        'options'     => [],
    ],
    'lastname'                            => [
        'label'       => 'Last Name',
        'description' => 'A contact\'s last name',
        'groupName'   => 'contactinformation',
        'type'        => 'string',
        'fieldType'   => 'text',
        'options'     => [],
    ],
    'phone'                               => [
        'label'       => 'Phone Number',
        'groupName'   => 'contactinformation',
        'description' => 'A contact\'s primary phone number',
        'type'        => 'string',
        'fieldType'   => 'phonenumber',
        'options'     => [],
    ],
    'study_course'                        => [
        'label'       => 'Study Course',
        'groupName'   => 'contactinformation',
        'description' => 'A contact\'s study course',
        'type'        => 'string',
        'fieldType'   => 'text',
        'options'     => [],
    ],
    'desired_beginning'                   => [
        'label'       => 'Desired Beginning',
        'groupName'   => 'contactinformation',
        'description' => 'A contact\'s desired beginning',
        'type'        => 'string',
        'fieldType'   => 'text',
        'options'     => [],
    ],
    'previous_university'                 => [
        'label'       => 'Previous university',
        'groupName'   => 'contactinformation',
        'description' => 'A contact\'s previous university',
        'type'        => 'string',
        'fieldType'   => 'text',
        'options'     => [],
    ],
    'study_course_of_previous_university' => [
        'label'       => 'Study course of previous university',
        'groupName'   => 'contactinformation',
        'description' => 'A contact\'s study course of previous university',
        'type'        => 'string',
        'fieldType'   => 'text',
        'options'     => [],
    ],
    'application_submitted'               => [
        'label'       => 'Application submitted',
        'groupName'   => 'contactinformation',
        'description' => 'NAK contact\'s application submitted',
        'type'        => 'enumeration',
        'fieldType'   => 'booleancheckbox',
        'options'     => [
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
    'application_accepted'                => [
        'label'       => 'Application accepted',
        'groupName'   => 'contactinformation',
        'description' => 'NAK contact\'s application accepted',
        'type'        => 'enumeration',
        'fieldType'   => 'booleancheckbox',
        'options'     => [
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
    'test_completed'                      => [
        'label'       => 'Test completed',
        'groupName'   => 'contactinformation',
        'description' => 'NAK contact\'s test completed',
        'type'        => 'enumeration',
        'fieldType'   => 'booleancheckbox',
        'options'     => [
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
    'selection_interview_on'              => [
        'label'       => 'Selection interview on',
        'groupName'   => 'contactinformation',
        'description' => 'Date this contact\'s selection interview on',
        'type'        => 'datetime',
        'fieldType'   => 'date',
        'options'     => [],
    ],
    'contract_sent_on'                    => [
        'label'       => 'Contract send on',
        'groupName'   => 'contactinformation',
        'description' => 'Date this contact\'s contract send on',
        'type'        => 'datetime',
        'fieldType'   => 'date',
        'options'     => [],
    ],
    'contract_returned_on'                => [
        'label'       => 'Contract returned',
        'groupName'   => 'contactinformation',
        'description' => 'Date this contact\'s contract returned',
        'type'        => 'datetime',
        'fieldType'   => 'date',
        'options'     => [],
    ],
    'rejected_by_applicant'               => [
        'label'       => 'Rejected by applicant',
        'groupName'   => 'contactinformation',
        'description' => 'A contact\'s rejected application',
        'type'        => 'enumeration',
        'fieldType'   => 'booleancheckbox',
        'options'     => [
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
    'rejected_by_nak'                     => [
        'label'       => 'Rejected by NAK',
        'groupName'   => 'contactinformation',
        'description' => 'A contact\'s application rejected by NAK',
        'type'        => 'enumeration',
        'fieldType'   => 'booleancheckbox',
        'options'     => [
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
