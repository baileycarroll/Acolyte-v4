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
        Schema::create('user_content', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user')->nullable()->references('id')->on('users');
            $table->foreignId('course')->nullable()->references('id')->on('courses');
            $table->foreignId('class')->nullable()->references('id')->on('classes');
            $table->date('last_accessed')->nullable();
            $table->date('completed_on')->nullable();
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
        Schema::dropIfExists('user_contents');
    }
};
