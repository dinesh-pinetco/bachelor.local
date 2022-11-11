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
            $table->enum('payment', [StudySheet::payments()])->nullable()->default(StudySheet::PAYMENT_INSTALLMENT);
            $table->enum('billing_address', [StudySheet::address()])->nullable()->default(StudySheet::ADDRESS_MAIN_ADDRESS);
            $table->json('custom_billing_address')->nullable();
            $table->enum('delivery_address', [StudySheet::address()])->nullable()->default(StudySheet::ADDRESS_MAIN_ADDRESS);
            $table->json('custom_delivery_address')->nullable();
            $table->boolean('privacy_policy')->nullable()->default(false);
            $table->integer('health_insurance_type')->comment('1=Private, 2=Legal')->nullable();
            $table->string('health_insurance_number', 50)->nullable();
            $table->foreignId('health_insurance_company_id')->nullable();
            $table->string('health_insurance_company', 100)->nullable();
            $table->string('account_holder', 50)->nullable();
            $table->string('iban', 30)->nullable();
            $table->string('swift_code', 30)->nullable();
            $table->boolean('is_authorize')->default(false)->nullable();
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
