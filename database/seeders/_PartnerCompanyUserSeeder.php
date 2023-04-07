<?php

namespace Database\Seeders;

use App\Enums\ApplicationStatus;
use App\Models\Media;
use App\Models\User;
use App\Models\UserConfiguration;
use App\Services\SyncUserValue;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class _PartnerCompanyUserSeeder extends Seeder
{
    public function run()
    {
        $users = tap(User::factory(2)->create(['application_status' => ApplicationStatus::REGISTRATION_SUBMITTED]), function ($users) {
            $users->each(function ($user) {
                $user->assignRole(ROLE_APPLICANT);
                $user->attachCourseWithDesiredBeginning((new Carbon('first day of October'))->toDateString(), [1]);
                (new SyncUserValue($user))();
            });
        });

        $this->submitProfile($users);

        $this->selectionTestPassed($users);

        $this->testResultRetrievedOn($users);

        $this->industriesFilled($users);

        $this->motivationFilled($users);

        $this->documentFilled($users);

        $this->personalDataCompleted($users);

        $this->directApplyToCompany($users);

        $this->appliedToCompany($users);
    }

    public static function submitProfile($users)
    {
        \File::copy(public_path('images/sample-profile-picture.jpg'), storage_path('app/profile/sample-profile-picture.jpg'));

        foreach ($users as $user) {
            $syncUser = (new SyncUserValue($user));
            $syncUser->fieldInsert('avatar', 'profile/sample-profile-picture.jpg');
            $syncUser->fieldInsert('gender', 'mr');
            $syncUser->fieldInsert('first_name', $user->first_name);
            $syncUser->fieldInsert('last_name', $user->last_name);
            $syncUser->fieldInsert('street_house_number', 'C-8393 first street');
            $syncUser->fieldInsert('postal_code', '123456');
            $syncUser->fieldInsert('location', 'TestLocation');
            $syncUser->fieldInsert('country', 'TestCountry');
            $syncUser->fieldInsert('email', $user->emails);
            $syncUser->fieldInsert('email_repetition', $user->email);
            $syncUser->fieldInsert('phone', $user->phone ?? '1234567890');
            $syncUser->fieldInsert('date_of_birth', '1998-1-26');
            $syncUser->fieldInsert('privacy_policy', '1');

            $user->application_status = ApplicationStatus::PROFILE_INFORMATION_COMPLETED;
            $user->save();
        }
    }

    public static function selectionTestPassed($users)
    {
        foreach ($users as $user) {
            seed_fake_test_results($user);
        }
    }

    public static function testResultRetrievedOn($users)
    {
        foreach ($users as $user) {
            $pdfPath = sprintf('test-results/%s.pdf', Str::kebab(class_basename($user->id.' '.$user->full_name.' passed result')));

            UserConfiguration::updateOrCreate(['user_id' => $user->id], [
                'selection_test_result_passed_pdf_path' => $pdfPath,
                'pass_pdf_created_at' => now(),
            ]);

            $user->update(['application_status' => ApplicationStatus::TEST_RESULT_PDF_RETRIEVED_ON()]);
        }
    }

    public static function industriesFilled($users)
    {
        foreach ($users as $user) {
            $syncUser = (new SyncUserValue($user));
            $syncUser->fieldInsert('industry', '[1, 2]');
        }
    }

    public static function motivationFilled($users)
    {
        foreach ($users as $user) {
            $user->values()->create([
                'field_id' => 23,
                'group_key' => $user->id.'1'.'0',
                'value' => 'Quia reprehenderit ',
            ]);

            $user->values()->create([
                'field_id' => 24,
                'group_key' => $user->id.'1'.'0',
                'value' => '["belastbar","analytisch"]',
            ]);

            $user->values()->create([
                'field_id' => 25,
                'group_key' => $user->id.'1'.'0',
                'value' => 'Quia reprehenderit ',
            ]);
        }
    }

    public static function documentFilled($users)
    {
        foreach ($users as $user) {
            \File::copy(public_path('sample.pdf'), storage_path('app/documents/sample.pdf'));

            Media::create([
                'user_id' => $user->id,
                'name' => 'sample.pdf',
                'path' => 'documents/sample.pdf',
                'extension' => 'pdf',
                'mime_type' => 'application/pdf',
                'size' => 3,
                'mediable_type' => 'App\Models\Document',
                'mediable_id' => 1,
                'tag' => 'CV',
            ]);

            Media::create([
                'user_id' => $user->id,
                'name' => 'sample.pdf',
                'path' => 'documents/sample.pdf',
                'extension' => 'pdf',
                'mime_type' => 'application/pdf',
                'size' => 3,
                'mediable_type' => 'App\Models\Document',
                'mediable_id' => 2,
                'tag' => 'Testimonies',
            ]);
        }
    }

    public static function personalDataCompleted($users)
    {
        foreach ($users as $user) {
            $user->update(['application_status' => ApplicationStatus::PERSONAL_DATA_COMPLETED()]);
        }
    }

    public static function directApplyToCompany($users)
    {
        foreach ($users as $user) {
            $user->update(['application_status' => ApplicationStatus::APPLYING_TO_SELECTED_COMPANY()]);
        }
    }

    public static function appliedToCompany($users)
    {
        foreach ($users as $user) {
            $user->companies()->create([
                'user_id' => $user->id,
                'company_id' => 1,
                'mail_content' => '<div>Test</div>',
            ]);

            $user->companies()->create([
                'user_id' => $user->id,
                'company_id' => 2,
                'mail_content' => '<div>Test</div>',
            ]);

            $user->touch('show_application_on_marketplace_at');

            $user->update(['application_status' => ApplicationStatus::APPLIED_TO_SELECTED_COMPANY()]);
        }
    }
}
