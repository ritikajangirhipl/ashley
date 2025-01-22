<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('countries', function (Blueprint $table) {
        $table->id(); 
        $table->string('name')->unique(); 
        $table->string('flag'); 
        $table->text('description'); 
        $table->string('currency_name'); 
        $table->string('currency_symbol'); 
        $table->enum('status', ['active', 'inactive']);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
