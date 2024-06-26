<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('customers', function (Blueprint $table) {
        $table->id();
        $table->string('sex');
        $table->string('marital_status');
        $table->integer('age');
        $table->string('education');
        $table->integer('income');
        $table->string('occupation');
        $table->string('settlement_size');
        $table->integer('cluster')->nullable();
        // $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('customers');
}
};