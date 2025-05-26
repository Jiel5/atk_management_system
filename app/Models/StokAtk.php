<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokAtk extends Model
{
    use HasFactory;

    protected $table = 'stok_atk';
    protected $fillable = ['atk_id', 'jumlah', 'satuan_id', 'harga_per_unit', 'tanggal_masuk'];

    public function atk()
    {
        return $this->belongsTo(Atk::class);
    }
    public function satuan()
    {
        return $this->belongsTo(Satuan::class);
    }
    public function kategori()
    {
        return $this->belongsTo(\App\Models\Kategori::class);
    }

}

