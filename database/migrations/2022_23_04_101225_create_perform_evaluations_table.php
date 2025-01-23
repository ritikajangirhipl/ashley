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
        Schema::create('perform_evaluations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('holder_submission_id');
            $table->string('nigeria',50);
            $table->string('degree',50);
            $table->string('comparability',50);
            $table->string('undergraduate_admission')->nullable();
            $table->string('admission_notes_1')->nullable();
            $table->string('admission_notes_2')->nullable();
            $table->string('summary_notes_1')->nullable();
            $table->string('summary_notes_2')->nullable();
            $table->string('summary_notes_3')->nullable();
            $table->boolean('is_stage5_completed')->default(0);
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
        Schema::dropIfExists('perform_evaluations');
    }
};
