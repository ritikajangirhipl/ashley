<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('processings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->enum('status', ['Not Started', 'Processing', 'Complete', 'Cancelled'])->default('Not Started');
            $table->enum('verification_outcome', ['Passed', 'Failed'])->nullable();
            $table->string('outcome_evidence')->nullable(); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('processings');
    }
};
