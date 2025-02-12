<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('sub_category_id')->constrained('sub_categories')->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->tinyInteger('subject')->unsigned()->nullable();
            $table->foreignId('verification_mode_id')->constrained('verification_modes')->onDelete('cascade');
            $table->text('verification_summary')->nullable();
            $table->foreignId('verification_provider_id')->constrained('verification_providers')->onDelete('cascade');
            $table->text('verification_duration')->nullable();
            $table->foreignId('evidence_type_id')->constrained('evidence_types')->onDelete('cascade');
            $table->text('evidence_summary')->nullable();
            $table->foreignId('service_partner_id')->constrained('service_partners')->onDelete('cascade');
            $table->string('service_currency')->nullable();
            $table->decimal('local_service_price',20,2)->nullable();
            $table->decimal('usd_service_price',20,2)->nullable();
            $table->boolean('subject_name')->default(0);
            $table->boolean('copy_of_document_to_verify')->default(0);
            $table->boolean('reason_for_request')->default(0);
            $table->boolean('subject_consent_requirement')->default(0);
            $table->boolean('name_of_reference_provider')->default(0);
            $table->boolean('address_information')->default(0);
            $table->boolean('location')->default(0);
            $table->boolean('gender')->default(0);
            $table->boolean('marital_status')->default(0);
            $table->boolean('registration_number')->default(0);
            $table->tinyInteger('status')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
};
