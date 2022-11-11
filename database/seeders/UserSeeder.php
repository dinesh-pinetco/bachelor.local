<?php

namespace Database\Seeders;

use App\Enums\ApplicationStatus;
use App\Models\User;
use App\Services\SyncUserValue;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'first_name' => 'Applicant',
            'last_name' => 'Applicant',
            'email' => 'applicant@example.com',
            'application_status' => ApplicationStatus::REGISTRATION_SUBMITTED,
        ])->assignRole(ROLE_APPLICANT);
        $user->attachCourseWithDesiredBeginning(1, 1, (new Carbon('first day of October'))->toDateString());
        (new SyncUserValue($user))();

        $user = User::factory()->create([
            'first_name' => 'Pooja',
            'last_name' => 'Jadav',
            'email' => 'pooja@example.com',
            'locale' => 'en',
            'application_status' => ApplicationStatus::REGISTRATION_SUBMITTED,
        ])->assignRole(ROLE_APPLICANT);
        $user->attachCourseWithDesiredBeginning(1, 1, (new Carbon('first day of October'))->toDateString());
        (new SyncUserValue($user))();

        tap(User::factory(50)->create(['application_status' => ApplicationStatus::REGISTRATION_SUBMITTED]), function ($users) {
            $users->each->assignRole(ROLE_APPLICANT);
            $users->each->attachCourseWithDesiredBeginning(1, 1, (new Carbon('first day of October'))->toDateString());
            $users->each(function ($user) {
                (new SyncUserValue($user))();
            });
        });
    }
}
