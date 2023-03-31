<?php

namespace Database\Seeders;

use App\Enums\ApplicationStatus;
use App\Models\Result;
use App\Models\User;
use App\Models\UserConfiguration;
use App\Services\SyncUserValue;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class _TestFailedUserSeeder extends Seeder
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

        $this->selectionTestFailed($users);

        $this->testFailedConfirmed($users);
    }

    public function selectionTestFailed($users)
    {
        foreach ($users as $user) {
            for ($testId = 1; $testId <= 4; $testId++) {
                Result::factory()->create([
                    'user_id' => $user->id,
                    'status' => Result::STATUS_FAILED,
                    'is_passed' => true,
                    'result' => rand(40, 50),
                    'test_id' => $testId,
                ]);
            }

            Result::create([
                'user_id' => $user->id,
                'test_id' => 5,
                'status' => Result::STATUS_FAILED,
                'is_passed' => false,
                'result' => '1481-306525',
                'meta' => '1',
                'started_at' => now(),
                'completed_at' => now(),
            ]);

            Result::create([
                'user_id' => $user->id,
                'test_id' => 6,
                'status' => Result::STATUS_FAILED,
                'is_passed' => false,
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

            $user->update(['application_status' => ApplicationStatus::TEST_FAILED()]);
        }
    }

    public function testFailedConfirmed($users)
    {
        foreach ($users as $user) {
            $pdfPath = sprintf('test-results/%s.pdf', Str::kebab(class_basename($user->id.' '.$user->full_name.' passed result')));

            UserConfiguration::updateOrCreate(['user_id' => $user->id], [
                'selection_test_result_failed_pdf_path' => $pdfPath,
                'fail_pdf_created_at' => now(),
            ]);

            $user->update(['application_status' => ApplicationStatus::TEST_FAILED_CONFIRM()]);
        }
    }
}
