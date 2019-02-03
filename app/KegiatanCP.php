<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KegiatanCP extends Model
{
    // Mendefinisikan nama table
   protected $table = 'kegiatan_cp';

   // Mendefinisikan primary key
   protected $primaryKey = "id_kegiatan_cp";

   protected $fillable = [
       'id_kegiatan_cp', 'jenis_kegiatan', 'tempat_kegiatan', 'bidang_kegiatan',
   ];

   public $timestamps = true;

   public function cp(){
        return $this->hasOne('App\DaftarCP');
   }
}
