<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlOpeningBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gl_opening_balances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('coa_id')->unsigned();
            $table->string('period', 10);
            $table->bigInteger('opening_balance');
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
        Schema::table('gl_opening_balancess', function (Blueprint $table) {
            $table->dropForeign('gl_opening_balances_coa_id_foreign');
        });
        Schema::dropIfExists('gl_opening_balances');
    }
}
