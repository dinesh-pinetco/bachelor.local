<?php

return [
    'option_tables' => [
        'courses',
        'desired_beginnings',
        'nationalities',
    ],
    'option_tables_key' => [
        'courses' => 'course_id',
        'desired_beginnings' => 'desired_beginning_id',
        'nationalities' => 'country_id',
    ],
    'applicants_fields' => [
        'email',
        'course_name',
        'course_start_date',
        'application_status_name',
        'created_at',
        'government_form_is_submit',
        'study_sheet_is_submit',
        'sanna_is_sync',
        'ects_point',
    ],
];
