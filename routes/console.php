<?php

use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('clean-dump:testing', function () {
    DB::table('applicant_companies')->truncate();
    DB::table('contracts')->truncate();
    DB::table('desired_beginnings')->truncate();
    DB::table('government_forms')->truncate();
    DB::table('meteors')->truncate();
    DB::table('moodles')->truncate();
    DB::table('results')->truncate();
    DB::table('study_sheets')->truncate();
    DB::table('user_configurations')->truncate();
    DB::table('user_hubspot_configurations')->truncate();

    User::all()->each(function ($user) {
        if($user->hasRole(ROLE_APPLICANT)){
            DB::table('media')->where('user_id', $user->id)->truncate();
            DB::table('audits')->where('user_id', $user->id)->truncate();
            DB::table('field_values')->where('user_id', $user->id)->truncate();
            DB::table('meta')->where('user_id', $user->id)->truncate();
            DB::table('model_has_courses')->where('user_id', $user->id)->truncate();
            DB::table('model_has_roles')->where('user_id', $user->id)->truncate();
            DB::table('sessions')->where('user_id', $user->id)->truncate();
        }
    });

    User::role(ROLE_APPLICANT)->forceDelete();
    User::all()->each(function ($user) {
        $user->update(['password' => Hash::make('nak@123#')]);
    });

    $this->comment('Success');
});
