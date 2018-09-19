<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaftarCpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_cp', function (Blueprint $table) {
            $table->string('nip', 20)->primary('nip');
            $table->integer('id_users')->references('id_users')->on('users');
            $table->string('nama', 50);
            $table->text('alamat');
            $table->string('ttl', 50);
            $table->string('foto', 250);
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
        Schema::dropIfExists('daftar_cp');
    }
}
