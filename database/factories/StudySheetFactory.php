<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudySheet>
 */
class StudySheetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'date_of_birth' => $this->faker->date,
            'place_of_birth' => $this->faker->city,
            'country_of_birth' => $this->faker->country,
            'nationality_first' => $this->faker->text,
            'nationality_second' => $this->faker->text,
            'student_id_card_photo' => $this->faker->filePath(),
            'have_health_insurance' => $this->faker->boolean,
            'is_health_insurance_private' => $this->faker->boolean,
            'health_insurance_company_id' => $this->faker->numerify,
            'health_insurance_number' => $this->faker->numerify,
            'school' => $this->faker->company,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'street' => $this->faker->streetAddress,
            'zip' => $this->faker->numberBetween(111, 999),
            'place' => $this->faker->city,
            'privacy_policy' => $this->faker->boolean,
        ];
    }
}
