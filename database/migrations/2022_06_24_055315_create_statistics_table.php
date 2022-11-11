<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id');
            $table->date('desired_beginning_date');
            $table->bigInteger('total_applicants')->comment('Total applicant register')->default(0);
            $table->bigInteger('checked_competency_catch_up')->comment('Total applicant add competency catch up.')->default(0);
            $table->bigInteger('rejected_applicants')->comment('Total applicant reject the application.')->default(0);
            $table->bigInteger('incomplete_applications')->comment('Total application of incomplete stage.')->default(0);
            $table->bigInteger('submitted_applications')->comment('Total application of submitted stage.')->default(0);
            $table->bigInteger('approved_applications')->comment('Total application of approved stage.')->default(0);
            $table->bigInteger('rejected_applications_before_approved_stage')->comment('Reject application before the approved stage.')->default(0);
            $table->bigInteger('test_completed')->comment('Total application of test completed stage.')->default(0);
            $table->bigInteger('rejected_applications_before_test_stage')->comment('Reject application before the test stage.')->default(0);
            $table->bigInteger('completed_interviews')->comment('Total application of interview completed stage.')->default(0);
            $table->bigInteger('rejected_applications_before_interview_stage')->comment('Reject application before the interview stage.')->default(0);
            $table->bigInteger('contract_sent')->comment('Total application of contract send out stage.')->default(0);
            $table->bigInteger('rejected_applications_before_contract_sent')->comment('Reject application before the contract send stage')->default(0);
            $table->bigInteger('contract_return')->comment('Total application of contract send back stage.')->default(0);
            $table->bigInteger('rejected_applications_before_contract_return')->comment('Reject application before the contract back stage.')->default(0);
            $table->bigInteger('application_enroll')->comment('Total application of application close stage.')->default(0);
            $table->bigInteger('rejected_applications_before_submitted_stage')
                ->comment('Reject application before the submitted stage.')->default(0);
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
        Schema::dropIfExists('statistics');
    }
}
