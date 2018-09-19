<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    // Mendefinisikan nama table
    protected $table = 'status';

    // Mendefinisikan primary key
    protected $primaryKey = "id_status";

    protected $fillable = [
    	'id_status', 'nama',
    ];

    // Memberitahu laravel bahwa table ini tidak memiliki kolom created_at & updated_at
    public $timestamps = true;

    public function user(){
        return $this->hasMany('App/User');
    }
}
