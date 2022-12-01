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
/*     public function up()
    {
        Schema::create('B039S', function (Blueprint $table) {
            $table->id();
            $table->string('hello'); //varchar型のカラム「hello」を作成する
            $table->string('world'); //「world」を作成する
            $table->timestamps();
        });
    }
 */
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('B039S');
    }
};
