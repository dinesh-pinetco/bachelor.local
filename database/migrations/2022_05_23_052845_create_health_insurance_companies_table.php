<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthInsuranceCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_insurance_companies', function (Blueprint $table) {
            $table->id();
            $table->string('sana_id')->nullable();
            $table->string('short_description')->nullable();
            $table->string('name1')->nullable();
            $table->string('name2')->nullable();
            $table->string('name3')->nullable();
            $table->string('company_number')->nullable();
            $table->string('institution_identifier')->nullable();
            $table->string('establishment_number_data_receiving_office')->nullable();
            $table->string('ik_this_user')->nullable();
            $table->string('ik_this_physical')->nullable();
            $table->string('valid_until')->nullable();
            $table->string('succession_bn')->nullable();
            $table->string('version')->nullable();
            $table->boolean('status')->default('1')->comment('1=Active, 0=Block');
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
        Schema::dropIfExists('health_insurance_companies');
    }
}
