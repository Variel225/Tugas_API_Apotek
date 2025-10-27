<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
     protected $fillable = ['nama_obat', 'produsen_obat', 'stok', 'harga', 'kategori_id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id','id');
    }
}
