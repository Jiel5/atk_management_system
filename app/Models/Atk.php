<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atk extends Model
{
    use HasFactory;
    protected $table = 'atk';
    protected $fillable = ['nama_atk', 'kategori_id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function stok()
    {
        return $this->hasMany(StokAtk::class);
    }

    public function pemasukan()
    {
        return $this->hasMany(PemasukanAtk::class);
    }

    public function pengeluaran()
    {
        return $this->hasMany(PengeluaranAtk::class);
    }
    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id');
    }
}

