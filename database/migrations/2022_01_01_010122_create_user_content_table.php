<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_content', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user')->nullable()->constrained('users');
            $table->foreignId('course')->nullable()->constrained('courses');
            $table->foreignId('class')->nullable()->constrained('classes');
            $table->date('last_accessed')->nullable();
            $table->date('completed_on')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('user_contents');
    }
};
