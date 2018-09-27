<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaftarPerusahaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_perusahaan', function (Blueprint $table) {
            $table->increments('id_perusahaan');
            $table->integer('id_user')->references('id_user')->on('users');
            $table->integer('id_kontak')->references('id_kontak')->on('kontak');
            $table->string('nama', 100);
            $table->text('alamat')->nullable();
            $table->text('bio')->nullable();
            $table->string('foto', 255)->nullable();
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
        Schema::dropIfExists('daftar_perusahaan');
    }
}
