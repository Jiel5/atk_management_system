<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPermintaan extends Model
{
    use HasFactory;
    protected $table = 'detail_permintaan';
    protected $fillable = ['permintaan_id', 'atk_id', 'jumlah', 'satuan_id'];

    public function permintaan()
    {
        return $this->belongsTo(PermintaanAtk::class);
    }

    public function atk()
    {
        return $this->belongsTo(Atk::class);
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class);
    }
}

