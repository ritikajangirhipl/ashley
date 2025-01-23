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
        Schema::create('validate_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('holder_submission_id');
            $table->boolean('is_report_validate')->default(0);
            $table->boolean('is_stage7_completed')->default(0);
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
        Schema::dropIfExists('validate_reports');
    }
};
