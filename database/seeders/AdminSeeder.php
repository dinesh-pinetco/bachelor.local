<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->hasPreference()->create([
            'first_name' => 'Raviraj',
            'last_name' => 'Chauhan',
            'email' => 'raviraj@pinetco.com',
        ])->assignRole([ROLE_ADMIN, ROLE_SUPER_ADMIN]);

        User::factory()->hasPreference()->create([
            'first_name' => 'Pooja',
            'last_name' => 'Jadav',
            'email' => 'pooja@pinetco.com',
            'locale' => 'en',
        ])->assignRole([ROLE_ADMIN, ROLE_SUPER_ADMIN]);

        User::factory()->hasPreference()->create([
            'first_name' => 'office',
            'last_name' => 'hamburg',
            'email' => 'office.hamburg@nordakademie.de',
        ])->assignRole(ROLE_ADMIN);
    }
}
