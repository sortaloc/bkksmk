<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loker extends Model
{
    // Mendefinisikan nama table
    protected $table = 'loker';

    // Mendefinisikan primary key
    protected $primaryKey = "id_loker";

    protected $fillable = [
    	'id_loker', 'id_perusahaan', 'judul', 'persyaratan', 'gaji', 'jam_kerja', 'keterangan_loker', 'brosur',
    ];

    // Memberitahu laravel bahwa table ini tidak memiliki kolom created_at & updated_at
    public $timestamps = true;

    public function perusahaan(){
        return $this->hasOne('App/DaftarPerusahaan');
    }
}
