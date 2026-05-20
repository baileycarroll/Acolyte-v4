<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course')->constrained('courses');
            $table->string('name')->unique();
            $table->text('description');
            $table->string('status')->default('Draft');
            $table->string('content_path');
            $table->date('available_on');
            $table->date('not_available')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('modules');
    }
};
