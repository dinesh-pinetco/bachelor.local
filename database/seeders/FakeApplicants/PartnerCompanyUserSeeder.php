<?php

namespace Database\Seeders\FakeApplicants;

use App\Enums\ApplicationStatus;
use App\Models\Media;
use App\Models\Result;
use App\Models\User;
use App\Models\UserConfiguration;
use App\Services\SyncUserValue;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PartnerCompanyUserSeeder extends Seeder
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
        \File::copy(public_path('images/sample-profile-picture.jpg'), storage_path('app/public/profile/sample-profile-picture.jpg'));

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
            for ($testId = 1; $testId <= 4; $testId++) {
                Result::factory()->create([
                    'user_id' => $user->id,
                    'status' => Result::STATUS_COMPLETED,
                    'is_passed' => true,
                    'result' => rand(80, 90),
                    'test_id' => $testId,
                ]);
            }

            Result::create([
                'user_id' => $user->id,
                'test_id' => 5,
                'status' => Result::STATUS_COMPLETED,
                'is_passed' => true,
                'result' => '1481-306525',
                'meta' => '1',
                'started_at' => now(),
                'completed_at' => now(),
            ]);

            Result::create([
                'user_id' => $user->id,
                'test_id' => 6,
                'status' => Result::STATUS_COMPLETED,
                'is_passed' => true,
                'result' => 'https://kern.viq16.com/api/transaction/result_report?p=d98282c08-79bs203738-b7fda-a8gg86992875&t=h83898f8aa39843993&l=de&d=viq-2022.pdf',
                'meta' => '{"viq-3":{"dimensions":{"s":51,"n":58,"t":62,"f":96,"j":93,"e":40,"i":60,"p":7},"absolute":{"s":1,"n":2,"t":3,"f":5,"j":4,"e":9,"i":16,"p":21},"short":"NF","full":"INFJ","short_psi":"AP","full_psi":"AP1"},"meta_data":{"tan":"b2852f9aa2064753","project_id":"d9276c06-70b2-4447-b3fa-a6ff57881085","started_at":"2023-03-18T13:43:49.173Z","finished_at":"2023-03-18T13:49:20.519Z","report_url":"https:\/\/kern.viq16.com\/api\/transaction\/result_report?p=d9276c06-70b2-4447-b3fa-a6ff57881085&t=b2852f9aa2064753&l=de&d=viq-2022.pdf","user_agent":"Mozilla\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/111.0.0.0 Safari\/537.36","form_data":"{\"naTan\":\"{g8PIYSJQ39}\"}"}}',
                'started_at' => now(),
                'completed_at' => now(),
            ]);

            Result::create([
                'user_id' => $user->id,
                'test_id' => 7,
                'status' => Result::STATUS_FAILED,
                'is_passed' => false,
                'result' => '12',
                'meta' => '{"viq-3":{"dimensions":{"s":51,"n":58,"t":62,"f":96,"j":93,"e":40,"i":60,"p":7},"absolute":{"s":1,"n":2,"t":3,"f":5,"j":4,"e":9,"i":16,"p":21},"short":"NF","full":"INFJ","short_psi":"AP","full_psi":"AP1"},"meta_data":{"tan":"b2852f9aa2064753","project_id":"d9276c06-70b2-4447-b3fa-a6ff57881085","started_at":"2023-03-18T13:43:49.173Z","finished_at":"2023-03-18T13:49:20.519Z","report_url":"https:\/\/kern.viq16.com\/api\/transaction\/result_report?p=d9276c06-70b2-4447-b3fa-a6ff57881085&t=b2852f9aa2064753&l=de&d=viq-2022.pdf","user_agent":"Mozilla\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/111.0.0.0 Safari\/537.36","form_data":"{\"naTan\":\"{g8PIYSJQ39}\"}"}}',
                'started_at' => now(),
                'completed_at' => now(),
            ]);

            $user->update(['application_status' => ApplicationStatus::TEST_PASSED()]);
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
            $syncUser->fieldInsert('industry', json_encode(['nader_group']));
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
                'value' => 'Quia reprehenderit ',
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
            \File::copy(public_path('sample.pdf'), storage_path('app/public/documents/sample.pdf'));

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
