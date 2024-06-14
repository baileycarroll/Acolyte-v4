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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department')->references('id')->on('departments');
            $table->string('name')->unique();
            $table->text('description');
            $table->text('excerpt')->nullable();
            $table->foreignId('instructor')->references('id')->on('users');
            $table->string('status')->default('Draft');
            $table->integer('spotlight')->default(0);
            $table->foreignId('learning_style')->references('id')->on('learning_styles');
            $table->foreignId('category_1')->references('id')->on('categories');
            $table->foreignId('category_2')->nullable()->references('id')->on('categories');
            $table->foreignId('category_3')->nullable()->references('id')->on('categories');
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
};
