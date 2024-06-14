<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('setup_keys', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('value');
            $table->string('old_value')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('setup_keys');
    }
};
