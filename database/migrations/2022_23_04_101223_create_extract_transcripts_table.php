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
        Schema::create('extract_transcripts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('holder_submission_id');
            $table->unsignedInteger('evaluation_template_id');
            $table->boolean('is_report_generated')->default(0);
            $table->string('report_name')->nullable();
            $table->boolean('is_stage3_completed')->default(0);
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
        Schema::dropIfExists('extract_transcripts');
    }
};
