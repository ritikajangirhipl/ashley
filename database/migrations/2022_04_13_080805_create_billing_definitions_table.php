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
        Schema::create('billing_definitions', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('billable');
            $table->unsignedInteger('degree_id');
            $table->decimal('receiver_fees', 10, 2)->nullable();
            $table->decimal('evaluation_fees', 10, 2)->nullable();
            $table->decimal('translation_fees', 10, 2)->nullable();
            $table->decimal('verification_fees', 10, 2)->nullable();
            $table->decimal('other_fees', 10, 2)->nullable();
            $table->decimal('total_fees', 10, 2)->nullable();
            $table->string('status',50); // enum casting
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
        Schema::dropIfExists('billing_definitions');
    }
};
