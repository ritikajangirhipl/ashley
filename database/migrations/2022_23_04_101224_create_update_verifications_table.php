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
        Schema::create('update_verifications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('holder_submission_id');

            $table->string('update_o_level_certificate_source',50);
            $table->string('update_o_level_certificate_status',50);
            $table->string('o_level_verification_status',50);

            $table->string('update_degree_certificate_source',50);
            $table->string('update_degree_certificate_status',50);
            $table->string('degree_verification_status',50);

            $table->string('update_transcript_source',50);
            $table->string('update_transcript_status',50);
            $table->string('transcript_verification_status',50);
            
            $table->boolean('is_verified',50);
            $table->boolean('is_stage4_completed')->default(0);
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
        Schema::dropIfExists('update_verifications');
    }
};
