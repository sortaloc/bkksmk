<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLokerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loker', function (Blueprint $table) {
            $table->increments('id_loker');
            $table->integer('id_perusahaan')->references('id_perusahaan')->on('daftar_perusahaan');
            $table->string('judul', 100);
            $table->text('persyaratan');
            $table->text('gaji');
            $table->text('jam_kerja');
            $table->text('keterangan_loker');
            $table->string('brosur', 250);
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
        Schema::dropIfExists('loker');
    }
}
