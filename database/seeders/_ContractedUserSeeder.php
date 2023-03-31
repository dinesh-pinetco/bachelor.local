<?php

namespace Database\Seeders;

use App\Enums\ApplicationStatus;
use App\Models\GovernmentForm;
use App\Models\StudySheet;
use App\Models\User;
use App\Services\SyncUserValue;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class _ContractedUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = tap(User::factory(2)->create(['application_status' => ApplicationStatus::REGISTRATION_SUBMITTED]), function ($users) {
            $users->each(function ($user) {
                $user->assignRole(ROLE_APPLICANT);
                $user->attachCourseWithDesiredBeginning((new Carbon('first day of October'))->toDateString(), [1]);
                (new SyncUserValue($user))();
            });
        });

        _PartnerCompanyUserSeeder::submitProfile($users);

        _PartnerCompanyUserSeeder::selectionTestPassed($users);

        _PartnerCompanyUserSeeder::testResultRetrievedOn($users);

        _PartnerCompanyUserSeeder::industriesFilled($users);

        _PartnerCompanyUserSeeder::motivationFilled($users);

        _PartnerCompanyUserSeeder::documentFilled($users);

        _PartnerCompanyUserSeeder::personalDataCompleted($users);

        _PartnerCompanyUserSeeder::directApplyToCompany($users);

        _PartnerCompanyUserSeeder::appliedToCompany($users);

        $this->enrollUser($users);

        $this->submitStudySheet($users);

        $this->submitGovernmentForm($users);

        $this->contract($users);
    }

    public function enrollUser($users)
    {
        foreach ($users as $user) {
            $syncUser = (new SyncUserValue($user));
            $syncUser->fieldInsert('enroll_course', 1);
            $syncUser->fieldInsert('enroll_company', 6);
            $syncUser->fieldInsert('enroll_company_contact', 18);

            $user->setMeta('enrollment_at', now());
        }
    }

    public function submitStudySheet($users)
    {
        foreach ($users as $user) {
            \File::copy(public_path('images/sample-profile-picture.jpg'), storage_path('app/public/student-id-photo/sample-profile-picture.jpg'));

            $user->study_sheet()->save(StudySheet::factory()->create([
                'user_id' => $user->id,
                'is_submit' => true,
            ]));
        }
    }

    public function submitGovernmentForm($users)
    {
        foreach ($users as $user) {
            $user->government_form()->save(GovernmentForm::factory()->create([
                'user_id' => $user->id,
                'is_submit' => true,
            ]));

            $user->update(['application_status' => ApplicationStatus::ENROLLMENT_ON()]);
        }
    }

    public function contract($users)
    {
        foreach ($users as $user) {
            $user->contract()->create([
                'user_id' => $user->id,
                'send_date' => '2023-03-23',
                'receive_date' => '2023-03-25',
            ]);

            $user->application_status = ApplicationStatus::CONTRACT_RETURNED_ON;

            $user->save();
        }
    }
}
