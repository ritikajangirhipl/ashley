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
        Schema::create('evaluation_template_mappings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('evaluation_template_id');
            $table->unsignedInteger('issuer_curriculum_details_id');
            $table->unsignedInteger('receiver_curriculum_details_id');
            $table->string('status',50); 
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
        Schema::dropIfExists('evaluation_template_mappings');
    }
};
