<?php

namespace Database\Seeders;

use App\Models\Field;
use Illuminate\Database\Seeder;

class ApplicantEnrolmentFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Field::create([
            'type' => 'select',
            'related_option_table' => 'enroll_course',
            'label' => 'Enroll Course',
            'key' => 'enroll_course',
            'placeholder' => 'Select Course',
            'is_required' => true,
        ]);

        Field::create([
            'type' => 'select',
            'related_option_table' => 'companies',
            'label' => 'Partner company',
            'key' => 'enroll_company',
            'placeholder' => 'Select partner company',
            'is_required' => true,
        ]);

        Field::create([
            'type' => 'select',
            'related_option_table' => 'company_contacts',
            'label' => 'Partner company contacts',
            'key' => 'enroll_company_contact',
            'placeholder' => 'Select company contacts',
            'is_required' => true,
        ]);
    }
}
