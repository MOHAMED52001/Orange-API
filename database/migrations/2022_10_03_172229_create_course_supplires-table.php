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
        Schema::create('courses_suppliers', function (Blueprint $table) {

            $table->foreignId('course_id')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('course_state')->nullable();

            $table->string('course_place')->nullable();

            $table->string('supplier');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
