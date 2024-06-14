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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('primary_department')->references('id')->on('departments');
            $table->foreignId('secondary_department')->nullable()->references('id')->on('departments');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('preferred_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->string('user_status')->default('Pending');
            $table->string('username')->unique();
            $table->string('password');
            $table->date('last_active')->nullable();
            $table->foreignId('learning_style')->references('id')->on('learning_styles');
            $table->foreignId('license')->references('id')->on('licenses');
            $table->date('license_starts')->nullable();
            $table->date('license_ends')->nullable();
            $table->date('license_origin')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
};
