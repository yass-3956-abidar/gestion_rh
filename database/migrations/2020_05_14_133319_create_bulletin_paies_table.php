<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBulletinPaiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bulletin_paies', function (Blueprint $table) {
            $table->id();
            $table->date('date_belletin');
            $table->bigInteger('employer_id');
            $table->integer('nbr_heur');
            $table->integer('nbr_heur_sup');
            $table->integer('nbr_jour_ferier');
            $table->integer('nbr_conget_pay');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bulletin_paies');
    }
}
