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
                'first_name' => 'Virendra',
                'last_name'  => 'Maurya',
                'email'      => 'virendra@pinetco.com',
                'locale'     => 'en',
            ])
        ->assignRole(ROLE_EMPLOYEE);

        User::factory()
            ->hasPreference()
            ->create([
                'first_name' => 'Anna',
                'last_name'  => 'Anna Zeidler ',
                'email'      => 'a.zeidler@pinetco.com',
            ])
        ->assignRole(ROLE_EMPLOYEE);

        User::factory()
            ->hasPreference()
            ->create([
                'first_name' => 'Employee',
                'last_name'  => 'User',
                'email'      => 'employee@nak.com',
            ])
        ->assignRole(ROLE_EMPLOYEE);

        User::factory()->create([
            'first_name' => 'Patricia',
            'last_name'  => 'Lichtenberg',
            'email'      => 'patricia.lichtenberg@nordakademie.de',
        ])->assignRole(ROLE_EMPLOYEE);
    }
}
