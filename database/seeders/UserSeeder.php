<?php

namespace Database\Seeders;

use App\Enums\ApplicationStatus;
use App\Models\DesiredBeginning;
use App\Models\User;
use App\Services\SyncUserValue;
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
        ]);
        $this->userCreatedProcess($user);

        //        tap(User::factory(50)->create(['application_status' => ApplicationStatus::REGISTRATION_SUBMITTED]), function ($users) {
        //            $users->each(function ($user) {
        //                $this->userCreatedProcess($user);
        //            });
        //        });
    }

    private function userCreatedProcess(User $user)
    {
        $user->assignRole(ROLE_APPLICANT);
        $desireBeginning = DesiredBeginning::inRandomOrder(1)->first();
        $user->attachCourseWithDesiredBeginning($desireBeginning->id, [$desireBeginning->courses()?->inRandomOrder()->first()?->id]);
        (new SyncUserValue($user))();
    }
}
