<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('verification_providers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade');
            $table->foreignId('provider_type_id')->constrained('provider_types')->onDelete('cascade');
            $table->text('contact_address')->nullable();
            $table->string('email')->unique();
            $table->string('website')->nullable();
            $table->string('contact_person')->nullable();
            $table->tinyInteger('status')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('verification_providers');
    }
};


