<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlJournalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gl_journal_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('journal_id')->unsigned();
            $table->integer('coa_id')->unsigned();
            $table->bigInteger('debet')->nullable();
            $table->bigInteger('kredit')->nullable();
            $table->foreign('journal_id')->references('id')->on('gl_journals');
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
        Schema::table('gl_journal_details', function (Blueprint $table) {
            $table->dropForeign('gl_journal_details_journal_id_foreign');
            $table->dropForeign('gl_journal_details_coa_id_foreign');
        });
        Schema::dropIfExists('gl_journal_details');
    }
}
