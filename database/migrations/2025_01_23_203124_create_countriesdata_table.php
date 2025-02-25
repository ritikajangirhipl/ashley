<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id(); 
            $table->string('slug'); 
            $table->string('name'); 
            $table->string('flag')->nullable();
            $table->text('description')->nullable(); 
            $table->string('currency_name'); 
            $table->string('currency_symbol'); 
            $table->tinyInteger('status')->unsigned()->nullable();
            $table->timestamps(); 
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('countries');
    }
};