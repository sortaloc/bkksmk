<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    // Mendefinisikan nama table
   protected $table = 'alumni';

   // Mendefinisikan primary key
   protected $primaryKey = "nis";

   protected $fillable = [
       'nis', 'nama', 'angkatan', 'created_at', 'updated_at'
   ];

   public $timestamps = true;
}
