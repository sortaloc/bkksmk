<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lamaran extends Model
{
    // Mendefinisikan nama table
    protected $table = 'lamaran';

    // Mendefinisikan primary key
    protected $primaryKey = "id_lamaran";

    protected $fillable = [
    	'id_lamaran', 'nis', 'id_loker', 'cv', 'surat_lamaran', 'keterangan_lamaran', 'status',
    ];

    // Memberitahu laravel bahwa table ini tidak memiliki kolom created_at & updated_at
    public $timestamps = true;

    public function daftarcp(){
        return $this->belongsTo('App\DaftarCP', 'nis');
    }

    public function loker(){
        return $this->hasOne('App\Loker', 'id_loker');
    }
}
