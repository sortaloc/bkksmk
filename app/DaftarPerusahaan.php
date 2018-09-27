<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DaftarPerusahaan extends Model
{
    // Mendefinisikan nama table
    protected $table = 'daftar_perusahaan';

    // Mendefinisikan primary key
    protected $primaryKey = "id_perusahaan";

    protected $fillable = [
    	'id_perusahaan', 'id_user', 'id_kontak', 'nama', 'alamat', 'bio', 'foto'
    ];

    // Memberitahu laravel bahwa table ini tidak memiliki kolom created_at & updated_at
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\\User', 'id_user');
    }

    public function kontak(){
        return $this->belongsTo('App\Kontak', 'id_kontak');
    }
}
