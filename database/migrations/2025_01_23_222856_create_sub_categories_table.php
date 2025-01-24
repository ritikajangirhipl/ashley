<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id('SubCategoryID'); // Primary key
            $table->unsignedBigInteger('CategoryID'); // Foreign key to categories table
            $table->string('name')->unique(); // Unique name
            $table->text('description')->nullable(); // Description
            $table->enum('status', ['active', 'inactive'])->default('active'); // Status
            $table->timestamps();
            $table->foreign('CategoryID')->references('CategoryID')->on('categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sub_categories');
    }
};
