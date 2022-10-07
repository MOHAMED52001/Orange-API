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
        Schema::create('student_course_registration', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->unique()->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('course_id')->unique()->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->timestamp('finished_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_course_registration');
    }
};
