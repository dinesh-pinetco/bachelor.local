<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGovernmentFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('government_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');

            $table->biginteger('country_id')->nullable();
            $table->biginteger('second_country_id')->nullable();

            $table->biginteger('previous_residence_country_id')->nullable();
            $table->biginteger('previous_residence_state_id')->nullable();
            $table->biginteger('previous_residence_district_id')->nullable();

            $table->biginteger('current_residence_country_id')->nullable();
            $table->biginteger('current_residence_state_id')->nullable();
            $table->biginteger('current_residence_district_id')->nullable();

            $table->biginteger('enrollment_university_id')->nullable();
            $table->string('enrollment_course')->nullable();
            $table->biginteger('enrollment_country_id')->nullable();
            $table->biginteger('enrollment_semester_id')->nullable();
            $table->integer('enrollment_year')->nullable();
            $table->integer('enrollment_total_semester')->nullable();

            $table->integer('graduation_year')->nullable();
            $table->integer('graduation_month')->nullable();
            $table->biginteger('graduation_entrance_qualification_id')->nullable();
            $table->biginteger('graduation_country_id')->nullable();
            $table->biginteger('graduation_state_id')->nullable();
            $table->biginteger('graduation_district_id')->nullable();

            $table->boolean('is_vocational_training_completed')->nullable();

            $table->boolean('is_previous_another_university')->nullable();
            $table->biginteger('previous_college_id')->nullable();
            $table->biginteger('previous_college_country_id')->nullable();
            $table->biginteger('previous_study_type_id')->nullable();
            $table->biginteger('previous_final_exam_id')->nullable();
            $table->biginteger('previous_course_id')->nullable();
            $table->biginteger('previous_second_course_id')->nullable();
            $table->biginteger('previous_third_course_id')->nullable();

            $table->biginteger('last_exam_university_id')->nullable();
            $table->biginteger('last_exam_country_id')->nullable();
            $table->biginteger('last_exam_id')->nullable();
            $table->biginteger('last_study_type_id')->nullable();
            $table->integer('last_exam_year')->nullable();
            $table->integer('last_exam_month')->nullable();
            $table->biginteger('last_exam_course_id')->nullable();
            $table->biginteger('last_exam_second_course_id')->nullable();
            $table->biginteger('last_exam_third_course_id')->nullable();
            $table->boolean('is_last_exam_pass')->nullable();
            $table->string('last_exam_grade')->nullable();

            $table->boolean('is_submit')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('government_forms');
    }
}
