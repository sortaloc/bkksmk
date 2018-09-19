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
    	'id_lamaran', 'nip', 'id_loker', 'cv', 'surat_lamaran', 'keterangan_lamaran', 'status',
    ];

    // Memberitahu laravel bahwa table ini tidak memiliki kolom created_at & updated_at
    public $timestamps = true;

    public function cp(){
        return $this->hasOne('App/DaftarCP');
    }
    public function loker(){
        return $this->hasOne('App/Loker');
    }
}
