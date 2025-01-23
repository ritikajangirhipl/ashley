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
        Schema::create('prepare_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('holder_submission_id');
            $table->boolean('is_evaluation_report_generated')->default(0);
            $table->string('evaluation_report_name')->nullable();
            
            $table->boolean('is_extraction_report_generated')->default(0);
            $table->string('extraction_report_name')->nullable();
            
            $table->boolean('is_both_merge')->default(0);
            $table->string('merge_report_name')->nullable();
            
            $table->boolean('is_stage6_completed')->default(0);
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
        Schema::dropIfExists('prepare_reports');
    }
};
