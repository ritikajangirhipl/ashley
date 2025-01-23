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
        Schema::create('request_verifications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('holder_submission_id');
            $table->string('o_level_certificate_source',50);
            $table->string('o_level_certificate_status',50);

            $table->string('degree_certificate_source',50);
            $table->string('degree_certificate_status',50);

            $table->string('academic_transcript_source',50);
            $table->string('academic_transcript_status',50);

            $table->boolean('is_requested')->default(0);
            $table->boolean('is_stage2_completed')->default(0);
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
        Schema::dropIfExists('request_verifications');
    }
};
