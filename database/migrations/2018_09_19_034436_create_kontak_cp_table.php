<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKontakCpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontak_cp', function (Blueprint $table) {
            $table->increments('id_kontak');
            $table->string('nip', 20)->references('nip')->on('daftar_cp');
            $table->string('no_hp', 20)->nullable();
            $table->string('no_telepon', 20)->nullable();
            $table->string('id_line', 50)->nullable();
            $table->text('kontak_dll')->nullable();
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
        Schema::dropIfExists('kontak_cp');
    }
}
