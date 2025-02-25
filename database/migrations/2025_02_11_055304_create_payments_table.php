<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); 
            $table->string('reference_number'); 
            $table->string('evidence')->nullable(); 
            $table->tinyInteger('status')->unsigned()->default(1); 
            $table->decimal('amount', 15, 2);  
            $table->string('currency', 10);  
            $table->timestamps();  
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
