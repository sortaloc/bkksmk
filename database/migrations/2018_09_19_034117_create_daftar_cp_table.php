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
            $table->string('nis', 20)->primary('nis');
            $table->integer('id_user')->references('id_user')->on('users');
            $table->integer('id_kontak')->references('id_kontak')->on('kontak');
            $table->string('nama', 50);
            $table->string('jenis_kelamin', 25);
            $table->string('cv', 255)->nullable();
            $table->text('alamat')->nullable();
            $table->string('ttl', 50)->nullable();
            $table->string('foto', 250)->nullable();
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
        Schema::dropIfExists('daftar_cp');
    }
}
