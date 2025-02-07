<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('client_type', ['individual', 'organization']);
            $table->string('email_address')->unique();
            $table->string('phone_number');
            $table->foreignId('country_id')->nullable()->constrained('countries')->onDelete('set null');
            $table->text('contact_address')->nullable();
            $table->string('website_address')->nullable();
            $table->string('password');
            $table->tinyInteger('status')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
};
