<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('student_resources', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description');
            $table->string('url');
            $table->foreignId('type')->constrained('resource_types');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('student_resources');
    }
};
