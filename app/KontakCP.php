<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KontakCP extends Model
{
	// Mendefinisikan nama table
    protected $table = 'kontak_cp';

    // Mendefinisikan primary key
    protected $primaryKey = "id_kontak";

    protected $fillable = [
    	'id_kontak', 'nip', 'no_hp', 'no_telepon', 'id_line', 'kontak_dll',
    ];

    // Memberitahu laravel bahwa table ini tidak memiliki kolom created_at & updated_at
    public $timestamps = true;

    public function cp(){
        return $this->hasOne('App/DaftarCP');
    }
}
