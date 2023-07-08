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
    public function up() : void
    {
        Schema::create('kangaroo', function (Blueprint $oTable) {
            $oTable->bigIncrements('id');
            $oTable->string('name', 50)->unique();
            $oTable->string('nickname', 20)->nullable();
            $oTable->float('weight');
            $oTable->float('height');
            $oTable->enum('gender', ['Male', 'Female']);
            $oTable->string('color', 20)->nullable();
            $oTable->enum('friendliness', ['friendly', 'not friendly'])->nullable();
            $oTable->date('birthday');
            $oTable->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() : void
    {
        Schema::dropIfExists('kangaroo');
    }
};
