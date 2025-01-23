<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('issuers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('country_id');
            $table->unsignedInteger('accreditation_body_id');
            $table->string('name', 191);
            $table->string('initial', 191);
            $table->string('website_url', 191);
            $table->string('email', 191);
            $table->string('address', 191);
            $table->string('contact_name', 191)->nullable();
            $table->string('contact_number', 191)->nullable();
            $table->string('contact_email', 191)->nullable();
            $table->string('type',50); // enum casting
            $table->string('recognition_status',50); // enum casting
            $table->string('accreditation_status',50); // enum casting
            $table->string('status',50); // enum casting
            $table->timestamps();
        });

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issuers');
    }
};
