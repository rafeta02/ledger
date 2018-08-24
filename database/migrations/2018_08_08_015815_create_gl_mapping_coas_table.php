<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlMappingCoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gl_mapping_coas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned();
            $table->integer('child_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('parent_id')->references('id')->on('gl_coas');
            $table->foreign('child_id')->references('id')->on('gl_coas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gl_mapping_coas', function (Blueprint $table) {
            $table->dropForeign('gl_mapping_coas_parent_id_foreign');
            $table->dropForeign('gl_mapping_coas_child_id_foreign');
        });
        Schema::dropIfExists('gl_mapping_coas');
    }
}
