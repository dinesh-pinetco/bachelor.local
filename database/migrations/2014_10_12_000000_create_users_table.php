<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('application_status')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('locale')->default('de');
            $table->text('phone')->nullable();
            $table->rememberToken();
            $table->string('cubia_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->boolean('competency_catch_up')->default(false);
            $table->mediumText('competency_comment')->nullable();
            $table->mediumText('application_reject_reason')->nullable();
            $table->boolean('is_synced_to_sanna')->default(false);
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('users');
    }
}
