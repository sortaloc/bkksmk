<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
	// Mendefinisikan nama table
    protected $table = 'kontak';

    // Mendefinisikan primary key
    protected $primaryKey = "id_kontak";

    protected $fillable = [
    	'id_kontak', 'no_hp', 'no_telepon', 'id_line', 'kontak_dll',
    ];

    // Memberitahu laravel bahwa table ini tidak memiliki kolom created_at & updated_at
    public $timestamps = true;

    public function cp(){
        return $this->hasOne('App\DaftarCP');
    }

    public function perusahaan(){
        return $this->hasOne('App\DaftarPerusahaan');
    }
}
