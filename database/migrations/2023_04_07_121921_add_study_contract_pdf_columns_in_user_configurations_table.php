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
        Schema::table('user_configurations', function (Blueprint $table) {
            $table->string('study_contract_pdf_path', 2048)->nullable()->after('contract_pdf_path');
            $table->date('study_contract_pdf_created_at')->nullable()->after('study_contract_pdf_path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_configurations', function (Blueprint $table) {
            $table->dropColumn('study_contract_pdf_path');
            $table->dropColumn('study_contract_pdf_created_at');
        });
    }
};
