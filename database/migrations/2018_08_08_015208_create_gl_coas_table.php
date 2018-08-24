<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlCoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gl_coas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 20);
            $table->string('name', 30);
            $table->integer('type_id')->unsigned();
            $table->enum('group', ['Neraca', 'Labarugi']);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('type_id')->references('id')->on('gl_type_coas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gl_coas', function (Blueprint $table) {
            $table->dropForeign('gl_coas_type_id_foreign');
        });
        Schema::dropIfExists('gl_coas');
    }
}
