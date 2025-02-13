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
            $table->string('subject_name');
            $table->text('document')->nullable();
            $table->enum('reason', ['admission', 'employment', 'other']);
            $table->text('subject_consent')->nullable();
            $table->string('reference_provider_name')->nullable();
            $table->text('address_information')->nullable();
            $table->foreignId('location')->constrained('countries')->onDelete('cascade');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->enum('marital_status', ['married', 'single', 'other']);
            $table->string('registration_number')->nullable();
            $table->text('others')->nullable();
            $table->enum('preferred_currency', ['USD', 'service_currency']);
            $table->decimal('order_amount', 15, 2);
            $table->unsignedBigInteger('payment_status')->nullable();
            $table->unsignedBigInteger('processing_status')->nullable();

            // Explicitly defining foreign key constraints
            $table->foreign('payment_status')->references('id')->on('payments')->onDelete('set null');
            $table->foreign('processing_status')->references('id')->on('processings')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
