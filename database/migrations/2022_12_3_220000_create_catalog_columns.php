<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->foreignId('catalog_id')->nullable()->constrained('catalogs');
        });
        Schema::table('courses', function (Blueprint $table) {
            $table->foreignId('catalog_id')->nullable()->constrained('catalogs');
        });
    }
    public function down()
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->dropColumn([
                'catalog_id'
            ]);
        });
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn([
                'catalog_id'
            ]);
        });
    }
};
