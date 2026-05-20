<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('gradebook', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user')->constrained('users');
            $table->foreignId('class')->nullable()->constrained('classes');
            $table->foreignId('course')->nullable()->constrained('courses');
            $table->foreignId('module')->nullable()->constrained('modules');
            $table->float('grade');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('gradebooks');
    }
};
