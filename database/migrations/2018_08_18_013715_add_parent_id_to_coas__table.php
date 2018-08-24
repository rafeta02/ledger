<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParentIdToCoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()//
    {
        Schema::table('gl_coas', function (Blueprint $table) {
            $table->integer('parent_id')->unsigned()->after('group')->nullable();
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
            $table->dropColumn('parent_id');
        });
    }
}
