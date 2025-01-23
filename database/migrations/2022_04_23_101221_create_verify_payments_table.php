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
        Schema::create('verify_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('holder_submission_id');
            $table->decimal('bill_amount', 10, 2)->nullable();
            $table->decimal('paid_amount', 10, 2)->nullable();
            $table->string('payment_status',50); // enum casting [Fully Paid, Partially Paid, Not Paid]
            $table->string('payment_ref',191); 
            $table->boolean('is_stage1_completed')->default(0);
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
        Schema::dropIfExists('verify_payments');
    }
};
