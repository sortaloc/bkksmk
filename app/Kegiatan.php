<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
   // Mendefinisikan nama table
   protected $table = 'kegiatan';

   // Mendefinisikan primary key
   protected $primaryKey = "id_kegiatan";

   protected $fillable = [
       'id_kegiatan', 'judul_kegiatan', 'foto_kegiatan', 'deskripsi_kegiatan',
   ];

   // Memberitahu laravel bahwa table ini tidak memiliki kolom created_at & updated_at
   public $timestamps = true;
}
