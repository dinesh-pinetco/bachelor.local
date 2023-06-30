<?php

namespace App\Traits;

trait GovernmentFormValidations
{
    protected function rules(): array
    {
        return [
            'governmentForm.country_id' => ['required', 'integer'],
            'governmentForm.second_country_id' => ['nullable', 'integer'],

            'governmentForm.previous_residence_country_id' => ['required', 'integer'],
            'governmentForm.previous_residence_state_id' => ['required_if:governmentForm.previous_residence_country_id,1', 'nullable', 'integer'],
            'governmentForm.previous_residence_district_id' => ['required_if:governmentForm.previous_residence_country_id,1', 'nullable', 'integer'],

            'governmentForm.current_residence_country_id' => ['required'],
            'governmentForm.current_residence_state_id' => ['required_if:governmentForm.current_residence_country_id,1'],
            'governmentForm.current_residence_district_id' => ['required_if:governmentForm.current_residence_country_id,1'],

            'governmentForm.enrollment_university_id' => ['required', 'integer'],
            'governmentForm.enrollment_course' => ['nullable'],
            'governmentForm.enrollment_country_id' => ['nullable', 'integer'],
            'governmentForm.enrollment_semester_id' => ['required', 'integer'],
            'governmentForm.enrollment_year' => ['required', 'integer', 'min:1900', 'max:2200'],
            'governmentForm.enrollment_total_semester' => ['required', 'integer', 'min:0'],

            'governmentForm.graduation_year' => ['required', 'integer', 'min:1900', 'max:2200'],
            'governmentForm.graduation_month' => ['required', 'integer', 'min:1', 'max:12'],
            'governmentForm.graduation_entrance_qualification_id' => ['required', 'integer'],
            'governmentForm.graduation_country_id' => ['required', 'integer'],
            'governmentForm.graduation_state_id' => ['required_if:governmentForm.graduation_country_id,1'],
            'governmentForm.graduation_district_id' => ['required_if:governmentForm.graduation_country_id,1'],

            'governmentForm.is_vocational_training_completed' => ['required'],

            'governmentForm.is_previous_another_university' => ['required'],
            'governmentForm.previous_college_id' => ['required_if:governmentForm.is_previous_another_university,1'],
            'governmentForm.previous_college_country_id' => ['nullable', 'integer'],
            'governmentForm.previous_study_type_id' => ['required_if:governmentForm.is_previous_another_university,1'],
            'governmentForm.previous_final_exam_id' => ['required_if:governmentForm.is_previous_another_university,1'],

            'governmentForm.previous_course_id' => ['nullable', 'integer'],
            'governmentForm.previous_second_course_id' => ['nullable', 'integer'],
            'governmentForm.previous_third_course_id' => ['nullable', 'integer'],

            'governmentForm.last_exam_university_id' => ['required'],
            'governmentForm.last_exam_country_id' => ['nullable'],
            'governmentForm.last_exam_id' => ['required', 'integer'],
            'governmentForm.last_study_type_id' => ['required', 'integer'],
            'governmentForm.last_exam_year' => ['nullable', 'integer', 'min:1900', 'max:2200'],
            'governmentForm.last_exam_month' => ['nullable', 'integer', 'min:1', 'max:12'],
            'governmentForm.last_exam_course_id' => ['nullable'],
            'governmentForm.last_exam_second_course_id' => ['nullable'],
            'governmentForm.last_exam_third_course_id' => ['nullable'],
            'governmentForm.is_last_exam_pass' => ['required'],
            'governmentForm.last_exam_grade' => ['nullable', 'regex:/[0-9]{1}.[0-9]{1}/u'],
        ];
    }

    protected function validationAttributes(): array
    {
        return [
            'governmentForm.country_id' => __('country'),
            'governmentForm.second_country_id' => __('second country'),

            'governmentForm.previous_residence_country_id' => __('previous residence country'),
            'governmentForm.previous_residence_state_id' => __('previous residence state'),
            'governmentForm.previous_residence_district_id' => __('previous residence district'),

            'governmentForm.current_residence_country_id' => __('current residence country'),
            'governmentForm.current_residence_state_id' => __('current residence state'),
            'governmentForm.current_residence_district_id' => __('current residence district'),

            'governmentForm.enrollment_university_id' => __('enrollment university'),
            'governmentForm.enrollment_course' => __('enrollment of university course'),
            'governmentForm.enrollment_country_id' => __('enrollment of university country'),
            'governmentForm.enrollment_semester_id' => __('enrollment of university semester'),
            'governmentForm.enrollment_year' => __('enrollment of university year'),
            'governmentForm.enrollment_total_semester' => __('enrollment of university total semester'),

            'governmentForm.graduation_year' => __('graduation year'),
            'governmentForm.graduation_month' => __('graduation month'),
            'governmentForm.graduation_entrance_qualification_id' => __('qualification of graduation entrance'),
            'governmentForm.graduation_country_id' => __('graduation country'),
            'governmentForm.graduation_state_id' => __('graduation state'),
            'governmentForm.graduation_district_id' => __('graduation district'),

            'governmentForm.is_vocational_training_completed' => __('is vocational training completed'),

            'governmentForm.is_previous_another_university' => __('is previous another university'),
            'governmentForm.previous_college_id' => __('previous college'),
            'governmentForm.previous_college_country_id' => __('previous college country'),
            'governmentForm.previous_study_type_id' => __('previous study type'),
            'governmentForm.previous_final_exam_id' => __('previous final exam'),
            'governmentForm.previous_course_id' => __('previous first course'),
            'governmentForm.previous_second_course_id' => __('previous second course'),
            'governmentForm.previous_third_course_id' => __('previous third course'),

            'governmentForm.last_exam_university_id' => __('university of last exam'),
            'governmentForm.last_exam_country_id' => __('is your last exam in abroad'),
            'governmentForm.last_exam_id' => __('last exam'),
            'governmentForm.last_study_type_id' => __('last exam study type'),
            'governmentForm.last_exam_year' => __('last exam study year'),
            'governmentForm.last_exam_month' => __('last exam study month'),
            'governmentForm.last_exam_course_id' => __('last exam first course'),
            'governmentForm.last_exam_second_course_id' => __('last exam second course'),
            'governmentForm.last_exam_third_course_id' => __('last exam third course'),
            'governmentForm.is_last_exam_pass' => __('is last exam pass'),
            'governmentForm.last_exam_grade' => __('grade of last exam'),
        ];
    }

    protected function messages(): array
    {
        return [
            'governmentForm.last_exam_grade.regex' => __('Please note the correct format (e.g 6.4)'),
            'governmentForm.previous_residence_state_id.required_if' => __('The state is required if your country is deutschland.'),
            'governmentForm.previous_residence_district_id.required_if' => __('The district is required if your country is deutschland.'),
            'governmentForm.current_residence_state_id.required_if' => __('The state is required if your country is deutschland.'),
            'governmentForm.current_residence_district_id.required_if' => __('The district is required if your country is deutschland.'),
            'governmentForm.graduation_state_id.required_if' => __('The state is required if your country is deutschland.'),
            'governmentForm.graduation_district_id.required_if' => __('The district is required if your country is deutschland.'),
            'governmentForm.previous_college_id.required_if' => __('The previous college is required If your previous university is another university.'),
            'governmentForm.previous_study_type_id.required_if' => __('The previous study type is required If your previous university is another university.'),
            'governmentForm.previous_final_exam_id.required_if' => __('The previous final exam is required If your previous university is another university.'),
        ];
    }
}
