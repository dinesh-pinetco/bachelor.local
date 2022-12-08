<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_configurations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->index();
            $table->boolean('competency_catch_up')->default(false);
            $table->mediumText('competency_comment')->nullable();
            $table->mediumText('application_reject_reason')->nullable();
            $table->boolean('is_synced_to_sanna')->default(false);
            $table->string('selection_test_result_passed_pdf_path', 2048)->nullable();
            $table->string('selection_test_result_failed_pdf_path', 2048)->nullable();
            $table->date('pass_pdf_created_at')->nullable();
            $table->date('fail_pdf_created_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_configurations');
    }
};
