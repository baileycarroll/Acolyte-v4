<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('primary_department')->constrained('departments');
            $table->foreignId('secondary_department')->nullable()->constrained('departments');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('preferred_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->string('user_status')->default('Pending');
            $table->string('username')->unique();
            $table->string('password');
            $table->date('last_active')->nullable();
            $table->foreignId('learning_style')->constrained('learning_styles');
            $table->foreignId('license')->constrained('licenses');
            $table->date('license_starts')->nullable();
            $table->date('license_ends')->nullable();
            $table->date('license_origin')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
