<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('discussions', function (Blueprint $table) {
            $table->id();
            $table->string('topic');
            $table->foreignId('related_class_1')->constrained('classes');
            $table->foreignId('related_module')->constrained('modules');
            $table->text('information');
            $table->integer('month');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('discussions');
    }
};
