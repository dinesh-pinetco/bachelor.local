<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('test_id');
            $table->string('status')->nullable();
            $table->boolean('is_passed')->default(false);
            $table->string('result')->nullable();
            $table->boolean('passed_by_nak')->default(false);
            $table->text('meta')->nullable();
            $table->boolean('is_passed_mix')->default(false);
            $table->string('result_mix_link')->nullable();
            $table->mediumText('meta_mix')->nullable();
            $table->boolean('is_passed_iqt')->default(false);
            $table->string('result_iqt_link')->nullable();
            $table->mediumText('meta_iqt')->nullable();
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
        Schema::dropIfExists('results');
    }
}
