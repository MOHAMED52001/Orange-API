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
        Schema::create('orange_supplier_contract', function (Blueprint $table) {
            $table->id();

            $table->string('supplier');

            $table->foreignId('course_id')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->decimal('course_cost', 7, 2);

            $table->string('course_state');

            $table->string('course_place');

            $table->timestamp('signed_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orange_supplier_contract');
    }
};
