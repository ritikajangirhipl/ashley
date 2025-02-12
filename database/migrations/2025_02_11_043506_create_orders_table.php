<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->string('name_of_subject');
            $table->string('copy_of_document')->nullable();
            $table->enum('reason_for_request', ['Admission', 'Employment', 'Other']);
            $table->string('subject_consent')->nullable();
            $table->string('name_of_reference_provider');
            $table->text('address_information')->nullable();
            $table->foreignId('location_id')->constrained('countries')->onDelete('cascade');
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->enum('marital_status', ['Married', 'Single', 'Other']);
            $table->string('registration_number')->nullable();
            $table->text('others')->nullable();
            $table->enum('preferred_currency', ['Service Currency', 'USD']);
            $table->decimal('order_amount', 10, 2);
            $table->enum('order_payment_status', ['Pending', 'Paid', 'Failed']);
            $table->enum('order_processing_status', ['Pending', 'Processing', 'Completed', 'Cancelled']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
