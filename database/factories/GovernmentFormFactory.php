<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GovernmentForm>
 */
class GovernmentFormFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'country_id' => $this->faker->numerify(), // ['required', 'integer'],
            'second_country_id' => $this->faker->numerify, // ['nullable', 'integer'],

            'previous_residence_country_id' => $this->faker->numerify, // ['required', 'integer'],
            'previous_residence_state_id' => $this->faker->numerify, // ['required_if:previous_residence_country_id,1', 'integer'],
            'previous_residence_district_id' => $this->faker->numerify, // ['required_if:previous_residence_country_id,1', 'integer'],

            'current_residence_country_id' => $this->faker->numerify, // ['required'],
            'current_residence_state_id' => $this->faker->numerify, // ['required_if:current_residence_country_id,1'],
            'current_residence_district_id' => $this->faker->numerify, // ['required_if:current_residence_country_id,1'],

            'enrollment_university_id' => $this->faker->numerify, // ['required', 'integer'],
            'enrollment_course' => $this->faker->word, // ['nullable'],
            'enrollment_country_id' => $this->faker->numerify, // ['nullable', 'integer'],
            'enrollment_semester_id' => $this->faker->numerify, // ['required', 'integer'],
            'enrollment_year' => $this->faker->year, // ['required', 'integer', 'min:1900', 'max:2200'],
            'enrollment_total_semester' => $this->faker->numerify, // ['required', 'integer', 'min:0'],

            'graduation_year' => $this->faker->year, // ['required', 'integer', 'min:1900', 'max:2200'],
            'graduation_month' => $this->faker->month, // ['required', 'integer', 'min:1', 'max:12'],
            'graduation_entrance_qualification_id' => $this->faker->numerify, // ['required', 'integer'],
            'graduation_country_id' => $this->faker->numerify, // ['required', 'integer'],
            'graduation_state_id' => $this->faker->numerify, // ['required_if:graduation_country_id,1'],
            'graduation_district_id' => $this->faker->numerify, // ['required_if:graduation_country_id,1'],

            'is_vocational_training_completed' => $this->faker->boolean, // ['required'],

            'is_previous_another_university' => $this->faker->boolean, // ['required'],
            'previous_college_id' => $this->faker->numerify, // ['required_if:is_previous_another_university,1'],
            'previous_college_country_id' => $this->faker->numerify, // ['nullable', 'integer'],
            'previous_study_type_id' => $this->faker->numerify, // ['required_if:is_previous_another_university,1'],
            'previous_final_exam_id' => $this->faker->numerify, // ['required_if:is_previous_another_university,1'],

            'previous_course_id' => $this->faker->numerify, // ['nullable', 'integer'],
            'previous_second_course_id' => $this->faker->numerify, // ['nullable', 'integer'],
            'previous_third_course_id' => $this->faker->numerify, // ['nullable', 'integer'],

            'last_exam_university_id' => $this->faker->numerify, // ['required'],
            'last_exam_country_id' => $this->faker->numerify, // ['nullable'],
            'last_exam_id' => $this->faker->numerify, // ['required', 'integer'],
            'last_study_type_id' => $this->faker->numerify, // ['required', 'integer'],
            'last_exam_year' => $this->faker->year, // ['integer', 'min:1900', 'max:2200'],
            'last_exam_month' => $this->faker->month, // ['integer', 'min:1', 'max:12'],
            'last_exam_course_id' => $this->faker->numerify, // ['nullable'],
            'last_exam_second_course_id' => $this->faker->numerify, // ['nullable'],
            'last_exam_third_course_id' => $this->faker->numerify, // ['nullable'],
            'is_last_exam_pass' => $this->faker->boolean, // ['required'],
            'last_exam_grade' => '2.8', // ['regex:/[0-9]{1}.[0-9]{1}/u'
            ];
    }
}
