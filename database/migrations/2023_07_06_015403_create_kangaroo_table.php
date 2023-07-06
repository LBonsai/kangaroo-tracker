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
        Schema::create('kangaroo', function (Blueprint $oTable) {
            $oTable->bigIncrements('id');
            $oTable->string('name', 255)->unique();
            $oTable->string('nickname', 60)->nullable();
            $oTable->float('weight');
            $oTable->float('height');
            $oTable->enum('gender', ['Male', 'Female'])->default('Male');
            $oTable->string('color', 60)->nullable();
            $oTable->enum('friendliness', ['friendly', 'not friendly'])->nullable();
            $oTable->date('birthday');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kangaroo');
    }
};
