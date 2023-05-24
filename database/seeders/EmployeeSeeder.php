<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->hasPreference()
            ->create([
                'first_name' => 'Anna',
                'last_name' => 'Zeidler',
                'email' => 'a.zeidler@pinetco.com',
            ])
            ->assignRole(ROLE_EMPLOYEE);

        User::factory()
            ->hasPreference()
            ->create([
                'first_name' => 'Employee',
                'last_name' => 'User',
                'email' => 'employee@nak.com',
            ])
            ->assignRole(ROLE_EMPLOYEE);

        User::factory()->create([
            'first_name' => 'Ulf',
            'last_name' => 'Wohlers',
            'email' => 'ulf.wohlers@nordakademie.de',
        ])->assignRole(ROLE_EMPLOYEE);
    }
}
