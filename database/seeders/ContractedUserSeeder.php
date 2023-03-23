<?php

namespace Database\Seeders;

use App\Enums\ApplicationStatus;
use App\Models\GovernmentForm;
use App\Models\StudySheet;
use App\Models\User;
use App\Services\SyncUserValue;
use Illuminate\Database\Seeder;

class ContractedUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create(['application_status' => ApplicationStatus::REGISTRATION_SUBMITTED]);

        PartnerCompanyUserSeeder::userCreatedProcess($user);

        PartnerCompanyUserSeeder::submitProfile($user);

        PartnerCompanyUserSeeder::selectionTestPassed($user);

        PartnerCompanyUserSeeder::testResultRetrievedOn($user);

        PartnerCompanyUserSeeder::industriesFilled($user);

        PartnerCompanyUserSeeder::motivationFilled($user);

        PartnerCompanyUserSeeder::documentFilled($user);

        PartnerCompanyUserSeeder::personalDataCompleted($user);

        PartnerCompanyUserSeeder::directApplyToCompany($user);

        PartnerCompanyUserSeeder::appliedToCompany($user);

        $this->enrollUser($user);

        $this->submitStudySheet($user);

        $this->submitGovernmentForm($user);

        $this->contract($user);
    }

    public function enrollUser(User $user)
    {
        $syncUser = (new SyncUserValue($user));
        $syncUser->fieldInsert('enroll_course', 1);
        $syncUser->fieldInsert('enroll_company', 6);
        $syncUser->fieldInsert('enroll_company_contact', 18);

        $user->setMeta('enrollment_at', now());
    }

    public function submitStudySheet(User $user)
    {
        $user->study_sheet()->save(StudySheet::factory()->create([
            'user_id' => $user->id,
            'is_submit' => true,
        ]));
    }

    public function submitGovernmentForm(User $user)
    {
        $user->government_form()->save(GovernmentForm::factory()->create([
            'user_id' => $user->id,
            'is_submit' => true,
        ]));

        $user->update(['application_status' => ApplicationStatus::ENROLLMENT_ON()]);
    }

    public function contract(User $user)
    {
        $user->contract()->create([
            'user_id' => $user->id,
            'send_date' => '2023-03-23',
            'receive_date' => '2023-03-25',
        ]);

        $user->application_status = ApplicationStatus::CONTRACT_SENT_ON;
        $user->application_status = ApplicationStatus::CONTRACT_RETURNED_ON;

        $user->save();
    }
}
