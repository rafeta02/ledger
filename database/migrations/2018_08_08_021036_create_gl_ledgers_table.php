<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gl_ledgers', function (Blueprint $table) {
            $table->increments('id');
            //$table->date('period');
            $table->string('period', 10);
            $table->integer('coa_id')->unsigned();
            $table->bigInteger('opening_balance');
            $table->bigInteger('debet_total');
            $table->bigInteger('kredit_total');
            $table->bigInteger('closing_balance');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('coa_id')->references('id')->on('gl_coas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gl_ledgers', function (Blueprint $table) {
            $table->dropForeign('gl_ledgers_coa_id_foreign');
        });
        Schema::dropIfExists('gl_ledgers');
    }
}
