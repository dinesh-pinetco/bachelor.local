<?php

use App\Models\StudySheet;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudySheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('study_sheets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('date_of_birth')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('country_of_birth')->nullable();
            $table->string('nationality_first')->nullable();
            $table->string('nationality_second')->nullable();
            $table->string('student_id_card_photo')->nullable();
            $table->boolean('have_health_insurance')->nullable()->default(false);
            $table->boolean('is_health_insurance_private')->nullable()->default(false);
            $table->integer('health_insurance_company_id')->nullable();
            $table->string('health_insurance_number', 50)->nullable();
            $table->string('school')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('street')->nullable();
            $table->integer('zip')->nullable();
            $table->string('place')->nullable();
            $table->boolean('is_authorize')->default(false)->nullable()->comment('For SEPA direct debit mandate');
            $table->boolean('privacy_policy')->nullable()->default(false);
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
        Schema::dropIfExists('study_sheets');
    }
}
