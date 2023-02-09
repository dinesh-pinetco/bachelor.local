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
            'related_option_table' => 'companies',
            'label' => __('Partner company'),
            'key' => 'id',
            'placeholder' => __('Select partner company'),
            'is_required' => true,
        ]);

        Field::create([
            'type' => 'multi_select',
            'related_option_table' => 'company_contacts',
            'label' => __('Partner company contacts'),
            'key' => 'id',
            'placeholder' => __('Select company contacts'),
            'is_required' => true,
        ]);
    }
}
