<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DaftarCP extends Model
{
    // Mendefinisikan nama table
    protected $table = 'daftar_cp';

    // Mendefinisikan primary key
    protected $primaryKey = "nip";

    protected $fillable = [
        'nip', 'id_user', 'nama', 'alamat', 'ttl', 'foto',
    ];

    // Memberitahu laravel bahwa table ini tidak memiliki kolom created_at & updated_at
    public $timestamps = true;

    public function user(){
        return $this->hasOne('App/User');
    }
}
