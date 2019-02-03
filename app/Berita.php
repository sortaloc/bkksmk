<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    // Mendefinisikan nama table
   protected $table = 'berita';

   // Mendefinisikan primary key
   protected $primaryKey = "id_berita";

   protected $fillable = [
       'id_berita', 'slug', 'judul_berita', 'isi_berita', 'penulis', 'foto_berita',
   ];

   public $timestamps = true;
}
