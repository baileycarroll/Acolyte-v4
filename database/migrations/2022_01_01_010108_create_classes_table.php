<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department')->constrained('departments');
            $table->string('name')->unique();
            $table->text('description');
            $table->text('excerpt')->nullable();
            $table->foreignId('instructor')->constrained('users');
            $table->string('status')->default('Draft');
            $table->integer('spotlight')->default(0);
            $table->foreignId('learning_style')->constrained('learning_styles');
            $table->foreignId('category_1')->constrained('categories');
            $table->foreignId('category_2')->nullable()->constrained('categories');
            $table->foreignId('category_3')->nullable()->constrained('categories');
            $table->foreignId('content_type')->constrained('content_types');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('classes');
    }
};
