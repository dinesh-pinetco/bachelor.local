<?php

namespace Database\Seeders;

use App\Enums\ApplicationStatus;
use App\Models\GovernmentForm;
use App\Models\StudySheet;
use App\Models\User;
use App\Services\SyncUserValue;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ContractedUserSeeder extends Seeder
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

        PartnerCompanyUserSeeder::submitProfile($users);

        PartnerCompanyUserSeeder::selectionTestPassed($users);

        PartnerCompanyUserSeeder::testResultRetrievedOn($users);

        PartnerCompanyUserSeeder::industriesFilled($users);

        PartnerCompanyUserSeeder::motivationFilled($users);

        PartnerCompanyUserSeeder::documentFilled($users);

        PartnerCompanyUserSeeder::personalDataCompleted($users);

        PartnerCompanyUserSeeder::directApplyToCompany($users);

        PartnerCompanyUserSeeder::appliedToCompany($users);

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

            Storage::putFileAs('student-id-photo', asset('images/facebook.png'), 'facebook.png');

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

            $user->application_status = ApplicationStatus::CONTRACT_SENT_ON;
            $user->application_status = ApplicationStatus::CONTRACT_RETURNED_ON;

            $user->save();
       }
    }
}
