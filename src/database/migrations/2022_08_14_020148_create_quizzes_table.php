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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->integer('class_id')->nullable();
            $table->integer('module_id')->nullable();
            $table->integer('num_questions')->default(3);
            $table->string('question_1');
            $table->string('q1_opt_1');
            $table->string('q1_opt_2');
            $table->string('q1_opt_3');
            $table->string('q1_correct');
            $table->string('question_2');
            $table->string('q2_opt_1');
            $table->string('q2_opt_2');
            $table->string('q2_opt_3');
            $table->string('q2_correct');
            $table->string('question_3');
            $table->string('q3_opt_1');
            $table->string('q3_opt_2');
            $table->string('q3_opt_3');
            $table->string('q3_correct');
            $table->string('question_4')->nullable();
            $table->string('q4_opt_1')->nullable();
            $table->string('q4_opt_2')->nullable();
            $table->string('q4_opt_3')->nullable();
            $table->string('q4_correct')->nullable();
            $table->string('question_5')->nullable();
            $table->string('q5_opt_1')->nullable();
            $table->string('q5_opt_2')->nullable();
            $table->string('q5_opt_3')->nullable();
            $table->string('q5_correct')->nullable();
            $table->string('question_6')->nullable();
            $table->string('q6_opt_1')->nullable();
            $table->string('q6_opt_2')->nullable();
            $table->string('q6_opt_3')->nullable();
            $table->string('q6_correct')->nullable();
            $table->string('question_7')->nullable();
            $table->string('q7_opt_1')->nullable();
            $table->string('q7_opt_2')->nullable();
            $table->string('q7_opt_3')->nullable();
            $table->string('q7_correct')->nullable();
            $table->string('question_8')->nullable();
            $table->string('q8_opt_1')->nullable();
            $table->string('q8_opt_2')->nullable();
            $table->string('q8_opt_3')->nullable();
            $table->string('q8_correct')->nullable();
            $table->string('question_9')->nullable();
            $table->string('q9_opt_1')->nullable();
            $table->string('q9_opt_2')->nullable();
            $table->string('q9_opt_3')->nullable();
            $table->string('q9_correct')->nullable();
            $table->string('question_10')->nullable();
            $table->string('q10_opt_1')->nullable();
            $table->string('q10_opt_2')->nullable();
            $table->string('q10_opt_3')->nullable();
            $table->string('q10_correct')->nullable();
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
        Schema::dropIfExists('quizzes');
    }
};
