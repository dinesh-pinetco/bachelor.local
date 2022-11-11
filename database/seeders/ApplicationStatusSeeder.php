<?php

namespace Database\Seeders;

use App\Models\ApplicationStatus;
use Illuminate\Database\Seeder;

class ApplicationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statusList = [
            'application_ incomplete' => 'Application incomplete',
            'application_submitted'   => 'Application submitted',
            'application_accepted'    => 'Application accepted',
            'test_completed'          => 'Test taken',
            'selection_interview_on'  => 'Selection interview on',
            'contract_sent_on'        => 'Contract sent on',
            'contract_returned_on'    => 'Contract returned on',
            'rejected_by_nak'         => 'Rejection by NAK',
            'rejected_by_applicant'   => 'Rejection by applicant',
        ];

        foreach ($statusList as $identifier => $status) {
            ApplicationStatus::create([
                'identifier' => $identifier,
                'name'       => $status,
            ]);
        }
    }
}
