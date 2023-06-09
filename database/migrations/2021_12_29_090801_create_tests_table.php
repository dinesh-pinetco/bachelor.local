<?php

use App\Models\Test;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id')->nullable();
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->enum('type', [Test::types()])->default(Test::TYPE_MOODLE);
            $table->boolean('has_passing_limit')->default(false);
            $table->float('passing_limit')->nullable();
            $table->decimal('duration')->comment('Duration in minutes');
            $table->boolean('is_required')->default(false);
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
        Schema::dropIfExists('tests');
    }
}
