<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBukuTamu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buku_tamu', function (Blueprint $table) {
            $table->increments('id_buku_tamu');
            $table->string('nama_pengirim', 255);
            $table->string('asal_pengirim', 255);
            $table->string('judul_pesan', 255);
            $table->string('email_pengirim', 255);
            $table->text('isi_pesan');
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
        Schema::dropIfExists('buku_tamu');
    }
}
