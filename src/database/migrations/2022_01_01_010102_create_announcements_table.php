<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->foreignId('department')->constrained('departments');
            $table->integer('department_only')->default(0);
            $table->date('expiration')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('announcements');
    }
};
