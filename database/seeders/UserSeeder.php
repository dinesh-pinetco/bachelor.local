<?php

namespace Database\Seeders;

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
            'last_name'  => 'Applicant',
            'email'      => 'applicant@example.com',
        ])->assignRole(ROLE_APPLICANT);
        $user->attachCourseWithDesiredBeginning(1, 1, (new Carbon('first day of October'))->toDateString());
        (new SyncUserValue($user))();

        $user = User::factory()->create([
            'first_name' => 'Pooja',
            'last_name'  => 'Jadav',
            'email'      => 'drgavali9@gmail.com',
            'locale'     => 'en',
        ])->assignRole(ROLE_APPLICANT);
        $user->attachCourseWithDesiredBeginning(1, 1, (new Carbon('first day of October'))->toDateString());
        (new SyncUserValue($user))();

        tap(User::factory(50)->create(), function ($users) {
            $users->each->assignRole(ROLE_APPLICANT);
            $users->each->attachCourseWithDesiredBeginning(1, 1, (new Carbon('first day of October'))->toDateString());
            $users->each(function ($user) {
                (new SyncUserValue($user))();
            });
        });
    }
}
