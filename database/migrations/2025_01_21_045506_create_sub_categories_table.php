<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id('SubCategoryID'); 
            $table->unsignedBigInteger('CategoryID');
            $table->string('Name')->unique(); 
            $table->text('Description');
            $table->enum('Status', ['Active', 'Inactive'])->default('Active'); 
            $table->timestamps();
        
            $table->foreign('CategoryID')->references('CategoryID')->on('categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sub_categories');
    }
};
