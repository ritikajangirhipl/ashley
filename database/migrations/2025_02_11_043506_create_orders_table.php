<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->string('subject_name');
            $table->string('copy_of_document_to_verify');
            $table->enum('reason_for_request', ['admission', 'employment', 'other']);
            $table->string('subject_consent_requirement');
            $table->string('name_of_reference_provider');
            $table->text('address_information');
            $table->foreignId('location_id')->constrained('countries')->onDelete('cascade');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->enum('marital_status', ['married', 'single', 'other']);
            $table->string('registration_number');
            $table->enum('preferred_currency', ['service_currency', 'usd']);
            $table->decimal('amount', 10, 2);
            $table->string('payment_status');
            $table->string('processing_status');
            $table->tinyInteger('status')->unsigned()->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};

