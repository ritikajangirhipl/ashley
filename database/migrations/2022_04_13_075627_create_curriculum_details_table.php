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
        Schema::create('curriculum_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('curriculum_id');
            $table->unsignedInteger('level_master_id'); // Select from 100, 200, 300, 400, 500 and 600
            $table->string('course_code', 191);
            $table->string('course_name', 191);
            $table->decimal('course_credits', 10, 2);
            $table->string('school_ref', 191); // Auto based on level
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
        Schema::dropIfExists('curriculum_details');
    }
};
