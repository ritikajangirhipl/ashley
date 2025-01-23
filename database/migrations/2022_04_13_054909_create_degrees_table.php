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
        Schema::create('degrees', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('degrable');
            $table->unsignedInteger('country_id');
            $table->unsignedInteger('accreditation_body_id');
            $table->string('qualification', 191);
            $table->string('program_length_required', 191);
            $table->longText('admission_requirement_1'); 
            $table->longText('admission_requirement_2'); 
            $table->string('course_type',50); // enum casting
            $table->string('specialization'); 
            $table->string('accreditation_status',50); // enum casting
            $table->string('status',50); // enum casting
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
        Schema::dropIfExists('degrees');
    }
};
