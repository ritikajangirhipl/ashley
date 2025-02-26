<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('service_partners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('country_id'); 
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->text('contact_address')->nullable();
            $table->string('email')->unique();
            $table->string('website_address')->nullable();
            $table->string('contact_person');
            $table->tinyInteger('status')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_partners');
    }
};
