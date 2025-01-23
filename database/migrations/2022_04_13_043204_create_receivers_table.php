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
        Schema::create('receivers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('country_id');
            $table->string('name', 191);
            $table->string('initial', 191);
            $table->string('website_url');
            $table->string('email', 191);
            $table->string('password')->nullable();
            $table->string('contact_name', 191);
            $table->string('contact_number', 191);
            $table->string('contact_email', 191);
            $table->string('status'); // enum casting
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
        Schema::dropIfExists('receivers');
    }
};
