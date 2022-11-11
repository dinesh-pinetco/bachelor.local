<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeteorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meteors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('na_tan')->comment('Unique identifier which we need to pass into meteor16 APIs');
            $table->string('t')->nullable()
                ->comment('Unique identifier which returned from meteor16 after test is completed');
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
        Schema::dropIfExists('meteors');
    }
}
