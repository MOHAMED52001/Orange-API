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
        Schema::create('orange_supplier_transactions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('contract_id');

            $table->foreign('contract_id')->references('id')->on('orange_supplier_contract')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->decimal('paid_amount', 7, 2);

            $table->timestamp('paid_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orange_supplier_transactions');
    }
};
