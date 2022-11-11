<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->integer('sana_id')->nullable();
            $table->integer('sort_order');
            $table->string('name');
            $table->text('description');
            $table->string('form_of_study');
            $table->date('first_start')
                ->comment('Start date of the course from when university started the providing education for this course')
                ->nullable();
            $table->date('last_start')
                ->comment('Start date of the course from when university stopped the providing education for this course')
                ->nullable();
            $table->integer('lead_time')->comment('Lead time defines the beginning of application in days.')->default(0);
            $table->integer('dead_time')->comment('The deadline defines the last possible application date.')->default(0);
            $table->boolean('is_active')->default(false);
            $table->softDeletes();
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
        Schema::dropIfExists('courses');
    }
}
