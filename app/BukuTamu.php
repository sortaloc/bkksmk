<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BukuTamu extends Model
{
    // Mendefinisikan nama table
    protected $table = 'buku_tamu';

    // Mendefinisikan primary key
    protected $primaryKey = "id_buku_tamu";

    protected $fillable = [
        'id_buku_tamu', 'nama_pengirim', 'asal_pengirim', 'email_pengirim', 'judul_pesan', 'isi_pesan'
    ];

    // Memberitahu laravel bahwa table ini tidak memiliki kolom created_at & updated_at
    public $timestamps = true;
}
