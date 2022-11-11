<?php

namespace App\Traits;

trait AuditableFunctionKeyMap
{
    private function matchFunction($key)
    {
        $functionMap = [
            'user_id'                              => 'user',
            'application_status_id'                => 'applicationStatus',
            'course_id'                            => 'course',
            'desired_beginning_id'                 => 'desiredBeginning',
            'parent_id'                            => 'group',
            'group_id'                             => 'group',
            'tab_id'                               => 'tab',
            'field_id'                             => 'field',
            'option_id'                            => 'option',
            'test_id'                              => 'test',
            'document_id'                          => 'document',
            'extension_id'                         => 'extension',
            'state_id'                             => 'state',
            'study_program_id'                     => 'studyProgram',
            'health_insurance_company_id'          => 'healthInsuranceCompany',
            'country_id'                           => 'nationality',
            'second_country_id'                    => 'nationality',
            'previous_residence_country_id'        => 'nationality',
            'previous_residence_state_id'          => 'state',
            'previous_residence_district_id'       => 'district',
            'current_residence_country_id'         => 'nationality',
            'current_residence_state_id'           => 'state',
            'current_residence_district_id'        => 'district',
            'enrollment_university_id'             => 'university',
            'enrollment_country_id'                => 'nationality',
            // 'enrollment_semester_id'=>'',
            'graduation_entrance_qualification_id' => 'entranceQualification',
            'graduation_country_id'                => 'nationality',
            'graduation_state_id'                  => 'state',
            'graduation_district_id'               => 'district',
            'previous_college_id'                  => 'university',
            'previous_college_country_id'          => 'nationality',
            'previous_study_type_id'               => 'studyType',
            'previous_final_exam_id'               => 'finalExam',
            'previous_course_id'                   => 'course',
            'previous_second_course_id'            => 'course',
            'previous_third_course_id'             => 'course',
            'last_exam_university_id'              => 'university',
            'last_exam_country_id'                 => 'nationality',
            'last_exam_id'                         => 'finalExam',
            'last_study_type_id'                   => 'studyType',
            'last_exam_course_id'                  => 'course',
            'last_exam_second_course_id'           => 'course',
            'last_exam_third_course_id'            => 'course',
            'college_id'                           => 'university',
        ];

        return $functionMap[$key] ?? null;
    }

    private function matchFunctionKey($key)
    {
        $functionMap = [
            'user_id'                              => 'fullName',
            'application_status_id'                => 'name',
            'course_id'                            => 'name',
            'desired_beginning_id'                 => 'name',
            'parent_id'                            => 'internal_name',
            'group_id'                             => 'internal_name',
            'tab_id'                               => 'name',
            'field_id'                             => 'label',
            'option_id'                            => 'value',
            'test_id'                              => 'name',
            'document_id'                          => 'name',
            'extension_id'                         => 'name',
            'state_id'                             => 'name',
            'study_program_id'                     => 'name',
            'health_insurance_company_id'          => 'short_description',
            'country_id'                           => 'name',
            'second_country_id'                    => 'name',
            'previous_residence_country_id'        => 'name',
            'previous_residence_state_id'          => 'name',
            'previous_residence_district_id'       => 'name',
            'current_residence_country_id'         => 'name',
            'current_residence_state_id'           => 'name',
            'current_residence_district_id'        => 'name',
            'enrollment_university_id'             => 'name',
            'enrollment_country_id'                => 'name',
            // 'enrollment_semester_id'=>'',
            'graduation_entrance_qualification_id' => 'name',
            'graduation_country_id'                => 'name',
            'graduation_state_id'                  => 'name',
            'graduation_district_id'               => 'name',
            'previous_college_id'                  => 'name',
            'previous_college_country_id'          => 'name',
            'previous_study_type_id'               => 'name',
            'previous_final_exam_id'               => 'name',
            'previous_course_id'                   => 'name',
            'previous_second_course_id'            => 'name',
            'previous_third_course_id'             => 'name',
            'last_exam_university_id'              => 'name',
            'last_exam_country_id'                 => 'name',
            'last_exam_id'                         => 'name',
            'last_study_type_id'                   => 'name',
            'last_exam_course_id'                  => 'name',
            'last_exam_second_course_id'           => 'name',
            'last_exam_third_course_id'            => 'name',
            'college_id'                           => 'name',
        ];

        return $functionMap[$key];
    }
}
