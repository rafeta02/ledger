<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlSetupDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gl_setup_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('setup_id')->unsigned();
            $table->integer('typecoa_id')->unsigned()->nullable();
            $table->integer('coa_id')->unsigned()->nullable();
            $table->foreign('setup_id')->references('id')->on('gl_setups');
            $table->foreign('typecoa_id')->references('id')->on('gl_type_coas');
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
        Schema::table('gl_setups', function (Blueprint $table) {
            $table->dropForeign('gl_setups_setup_id_foreign');
        });
        Schema::table('gl_type_coas', function (Blueprint $table) {
            $table->dropForeign('gl_type_coas_typecoa_id_foreign');
        });
        Schema::table('gl_coas', function (Blueprint $table) {
            $table->dropForeign('gl_coas_coa_id_foreign');
        });
        Schema::dropIfExists('gl_setup_details');
    }
}
