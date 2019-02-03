<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DaftarCP extends Model
{
    // Mendefinisikan nama table
    protected $table = 'daftar_cp';

    // Mendefinisikan primary key
    protected $primaryKey = "nis";

    protected $fillable = [
        'nis', 'id_user', 'id_kontak', 'id_kegiatan_cp', 'nama', 'alamat', 'ttl', 'foto', 'alumni'
    ];

    // Memberitahu laravel bahwa table ini tidak memiliki kolom created_at & updated_at
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User', 'id_user');
    }

    public function kontak(){
        return $this->belongsTo('App\Kontak', 'id_kontak');
    }

    public function kegiatanCP(){
        return $this->belongsTo('App\KegiatanCP', 'id_kegiatan_cp');
    }

    public function lamaran(){
        return $this->hasMany('App\Lamaran', 'nis');
    }
}
