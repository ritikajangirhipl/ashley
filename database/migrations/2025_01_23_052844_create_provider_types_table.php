<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('provider_types', function (Blueprint $table) {
            $table->id('ProviderTypeID');
            $table->string('name')->unique(); 
            $table->text('description'); 
            $table->enum('status', ['active', 'inactive'])->default('active'); 
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('provider_types');
    }
};
