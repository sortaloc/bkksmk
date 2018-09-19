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
            $table->integer('id_users')->references('id_users')->on('users');
            $table->string('nama', 100);
            $table->text('alamat');
            $table->text('bio');
            $table->string('foto', 250);
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
