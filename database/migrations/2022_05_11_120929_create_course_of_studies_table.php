<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseOfStudiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_of_studies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sana_id');
            $table->foreignId('study_program_id');
            $table->string('short_form', 20);
            $table->string('name');
            $table->string('name_en');
            $table->string('title');
            $table->string('title_short', 20);
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
        Schema::dropIfExists('course_of_studies');
    }
}
