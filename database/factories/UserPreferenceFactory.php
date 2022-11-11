<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserPreferenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::role(ROLE_EMPLOYEE)->inRandomOrder()->first(),
            'settings' => createJsonUserPrefence(),
            'type' => 'application_table',
        ];
    }
}
