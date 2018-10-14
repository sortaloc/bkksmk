<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLamaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lamaran', function (Blueprint $table) {
            $table->increments('id_lamaran');
            $table->string('nis', 20)->references('nis')->on('daftar_cp');
            $table->integer('id_loker')->references('id_loker')->on('loker');
            $table->string('surat_lamaran', 255);
            $table->text('keterangan_lamaran')->nullable();
            $table->string('status', 20);
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
        Schema::dropIfExists('lamaran');
    }
}
