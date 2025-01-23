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
        Schema::create('evaluation_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191);
            $table->unsignedInteger('issuer_id');
            $table->unsignedInteger('issuer_degree_id');
            $table->unsignedInteger('issuer_curriculum_id');
            $table->unsignedInteger('receiver_id');
            $table->unsignedInteger('receiver_degree_id');
            $table->unsignedInteger('receiver_curriculum_id');
            
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
        Schema::dropIfExists('evaluation_templates');
    }
};
