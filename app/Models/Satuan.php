<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $table = 'satuan'; // 👈 Tambahkan ini

    protected $fillable = ['nama_satuan'];

    public function stok()
    {
        return $this->hasMany(StokAtk::class);
    }
}
