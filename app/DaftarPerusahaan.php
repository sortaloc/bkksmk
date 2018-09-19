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
    	'id_perusahaan', 'id_user', 'nama', 'alamat', 'bio', 'foto'
    ];

    // Memberitahu laravel bahwa table ini tidak memiliki kolom created_at & updated_at
    public $timestamps = true;

    public function user(){
        return $this->hasOne('App/User');
    }
}
