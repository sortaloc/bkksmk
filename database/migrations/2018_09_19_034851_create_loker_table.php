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
            $table->integer('id_perusahaan')->references('id_perusahaan')->on('daftar_perusahaan')->nullable();
            $table->string('judul', 255);
            $table->text('persyaratan');
            $table->text('gaji');
            $table->text('jam_kerja');
            $table->text('keterangan_loker')->nullable();
            $table->string('brosur', 255)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
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
