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
    DB::table('media')->truncate();
    DB::table('audits')->truncate();
    DB::table('field_values')->truncate();
    DB::table('meta')->truncate();

    $users = User::query()->withTrashed()->role(ROLE_APPLICANT)->get();

    foreach ($users as $user) {
        User::where('id', $user->id)->forceDelete();
        DB::table('model_has_roles')->where('model_id', $user->id)->delete();
    }

    User::query()->update(['password' => Hash::make('nak@123#')]);

    $this->comment('Dump DB is ready to use!');
});

Artisan::command('import-db', function () {
    $password = $this->ask('What is database password?');

    Artisan::call('db:wipe');

    $sqlFile = database_path('mysql-nak_bachelor.sql');
    $databaseConfig = config('database.connections.mysql');

    $command = sprintf(
        'mysql --user=%s --password=%s --host=%s --database=%s < %s',
        $databaseConfig['username'],
        $password,
        $databaseConfig['host'],
        $databaseConfig['database'],
        $sqlFile
    );

    exec($command);

    $this->info('Database imported successfully.');
});
