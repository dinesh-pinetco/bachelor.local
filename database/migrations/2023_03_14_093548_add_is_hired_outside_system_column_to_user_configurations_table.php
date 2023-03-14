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
            $table->boolean('is_enrolled_outside_system')->after('fail_pdf_created_at')->nullable();
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
            $table->dropColumn('is_enrolled_outside_system');
        });
    }
};
