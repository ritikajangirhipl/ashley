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
        Schema::create('extract_transcript_mappings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('extract_transcript_id');
            $table->unsignedInteger('evaluation_template_mapping_id')->nullable();
            $table->unsignedInteger('issuer_curriculum_details_id')->nullable();
            $table->integer('earned')->nullable();
            $table->string('grade','20')->nullable();
            $table->decimal('point', 8, 2)->nullable();
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
        Schema::dropIfExists('extract_transcript_mappings');
    }
};
