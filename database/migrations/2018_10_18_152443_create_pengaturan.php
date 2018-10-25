<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengaturan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaturan', function (Blueprint $table) {
            $table->increments('id_pengaturan');
            $table->text('banner1');
            $table->text('foto1')->nullable();
            $table->text('fitur1');
            $table->text('fitur2');
            $table->text('fitur3');
            $table->text('tentang1');
            $table->text('tujuan1');
            $table->text('alamat');
            $table->text('telp');
            $table->text('fax');
            $table->text('email');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        DB::table('pengaturan')->insert(
            array(
                'banner1' => '<h1>BKK SMK</h1><p>Bursa Kerja Khusus SMK adalah sebuah aplikasi yang memudahkan para siswa / calon pegawai untuk mencari lowongan pekerjaan.</p>',
                'foto1' => 'nophoto.jpg',
                'fitur1' => 'Ada berbagai macam lowongan pekerjaan untuk siswa yang akan lulus.',
                'fitur2' => 'Berbagai lowongan pekerjaan dari berbagai perusahaan - perusahaan ternama.',
                'fitur3' => 'Anda bisa mencari berbagai macam lowongan pekerjaan yang sesuai dengan kemampuan.',
                'tentang1' => '<h1>BKK SMK</h1><p>Bursa Kerja Khusus SMK adalah sebuah aplikasi yang memudahkan para siswa / calon pegawai untuk mencari lowongan pekerjaan.</p>',
                'tujuan1' => '<p>Aplikasi ini dibuat dengan tujuan sebagai berikut:</p><ul><li>Untuk memudahkan para siswa untuk mencari lowongan pekerjaan sebelum lulus.</li><li>Dan lain lain.</li></ul>',
                'alamat' => 'Jalan Budhi Cilember, Sukaraja, Cicendo, Kota Bandung, Jawa Barat 40153',
                'telp' => '022-6652442',
                'fax' => '022-6613508',
                'email' => 'smkn11bdg@gmail.com'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengaturan');
    }
}
