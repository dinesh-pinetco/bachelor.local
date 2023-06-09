<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolePermissionSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(DesiredBeginningSeeder::class);
        $this->call(TabSeeder::class);
        $this->call(ApplicantEnrolmentFieldSeeder::class);
        $this->call(StateSeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(UniversitySeeder::class);
        $this->call(SchoolSeeder::class);
        $this->call(StudyTypeSeeder::class);
        $this->call(StudyProgramSeeder::class);
        $this->call(FinalExamSeeder::class);
        $this->call(NationalitySeeder::class);
        $this->call(IndustrySeeder::class);
        $this->call(EntranceQualificationSeeder::class);
        $this->call(HealthInsuranceCompanySeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(ExtensionSeeder::class);
        $this->call(DocumentSeeder::class);
        $this->call(TestSeeder::class);
        $this->call(ContactProfileSeeder::class);
        $this->call(FaqSeeder::class);

        Artisan::call('company:sync');
    }
}
