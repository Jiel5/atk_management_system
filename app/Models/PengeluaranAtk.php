<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengeluaranAtk extends Model
{
    use HasFactory;
    protected $table = 'pengeluaran_atk';
    protected $fillable = ['atk_id', 'jumlah', 'satuan_id', 'harga_per_unit', 'tanggal_keluar'];

    public function atk()
    {
        return $this->belongsTo(Atk::class);
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class);
    }
    public function permintaan()
    {
        return $this->belongsTo(PermintaanAtk::class, 'permintaan_id');
    }

}

