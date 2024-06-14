<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->nullable()->constrained('classes');
            $table->foreignId('module_id')->nullable()->constrained('modules');
            $table->integer('num_questions')->default(3);
            $table->text('question_1');
            $table->text('q1_opt_1');
            $table->text('q1_opt_2');
            $table->text('q1_opt_3');
            $table->text('q1_correct');
            $table->text('question_2');
            $table->text('q2_opt_1');
            $table->text('q2_opt_2');
            $table->text('q2_opt_3');
            $table->text('q2_correct');
            $table->text('question_3');
            $table->text('q3_opt_1');
            $table->text('q3_opt_2');
            $table->text('q3_opt_3');
            $table->text('q3_correct');
            $table->text('question_4')->nullable();
            $table->text('q4_opt_1')->nullable();
            $table->text('q4_opt_2')->nullable();
            $table->text('q4_opt_3')->nullable();
            $table->text('q4_correct')->nullable();
            $table->text('question_5')->nullable();
            $table->text('q5_opt_1')->nullable();
            $table->text('q5_opt_2')->nullable();
            $table->text('q5_opt_3')->nullable();
            $table->text('q5_correct')->nullable();
            $table->text('question_6')->nullable();
            $table->text('q6_opt_1')->nullable();
            $table->text('q6_opt_2')->nullable();
            $table->text('q6_opt_3')->nullable();
            $table->text('q6_correct')->nullable();
            $table->text('question_7')->nullable();
            $table->text('q7_opt_1')->nullable();
            $table->text('q7_opt_2')->nullable();
            $table->text('q7_opt_3')->nullable();
            $table->text('q7_correct')->nullable();
            $table->text('question_8')->nullable();
            $table->text('q8_opt_1')->nullable();
            $table->text('q8_opt_2')->nullable();
            $table->text('q8_opt_3')->nullable();
            $table->text('q8_correct')->nullable();
            $table->text('question_9')->nullable();
            $table->text('q9_opt_1')->nullable();
            $table->text('q9_opt_2')->nullable();
            $table->text('q9_opt_3')->nullable();
            $table->text('q9_correct')->nullable();
            $table->text('question_10')->nullable();
            $table->text('q10_opt_1')->nullable();
            $table->text('q10_opt_2')->nullable();
            $table->text('q10_opt_3')->nullable();
            $table->text('q10_correct')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
};
