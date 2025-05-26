<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemasukanAtk extends Model
{
    use HasFactory;
    protected $table = 'pemasukan_atk';
    protected $fillable = ['atk_id', 'jumlah', 'satuan_id', 'total_biaya', 'tanggal_masuk', 'keterangan'];

    public function atk()
    {
        return $this->belongsTo(Atk::class);
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class);
    }
}

