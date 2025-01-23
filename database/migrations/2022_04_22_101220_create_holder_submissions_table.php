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
        Schema::create('holder_submissions', function (Blueprint $table) {
            $table->increments('id');
            $table->date('submission_date')->nullable();
            $table->string('submission_ref', 191)->nullable(); 
            $table->unsignedInteger('student_id');  // Holder Name
            $table->unsignedInteger('issuer_id');
            $table->unsignedInteger('issuer_degree_id');
            $table->string('school_name', 191)->nullable(); 
            $table->integer('start_year')->nullable();
            $table->integer('end_year')->nullable();
            $table->unsignedInteger('receiver_id');
            $table->unsignedInteger('receiver_degree_id');
            $table->string('receiver_reference')->nullable();
            $table->decimal('fees_to_pay', 10, 2)->nullable();
            $table->string('status'); // enum casting
            $table->boolean('is_all_document_submitted')->default(0);
            $table->boolean('is_all_stage_completed')->default(0);

            $table->string('pre_stage',50)->nullable();
            $table->string('current_stage',50);
            $table->string('next_stage',50)->nullable();
            $table->boolean('is_stage0_completed')->default(1);
            $table->boolean('is_stage1_completed')->default(0);
            $table->boolean('is_stage2_completed')->default(0);
            $table->boolean('is_stage3_completed')->default(0);
            $table->boolean('is_stage4_completed')->default(0);
            $table->boolean('is_stage5_completed')->default(0);
            $table->boolean('is_stage6_completed')->default(0);
            $table->boolean('is_stage7_completed')->default(0);
            $table->boolean('is_stage8_completed')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('holder_submissions');
    }
};
