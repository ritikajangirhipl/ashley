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
        Schema::create('deliver_report_receivers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('deliver_report_id');
            $table->string('recipent_name')->nullable();
            $table->string('recipent_email')->nullable();
            $table->boolean('is_delivered')->default(0);
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
        Schema::dropIfExists('deliver_report_receivers');
    }
};
