<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    // Mendefinisikan nama table
    protected $table = 'pengaturan';

    // Mendefinisikan primary key
    protected $primaryKey = "id_pengaturan";

    protected $fillable = [
    	'id_pengaturan', 'banner1', 'fitur1', 'fitur2', 'fitur3', 'alamat', 'telp', 'fax', 'email'
    ];

    // Memberitahu laravel bahwa table ini tidak memiliki kolom created_at & updated_at
    public $timestamps = true;
}
