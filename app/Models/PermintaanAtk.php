<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanAtk extends Model
{
    use HasFactory;

    protected $table = 'permintaan_atk';
    protected $fillable = ['user_id', 'status', 'catatan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailPermintaan()
    {
        return $this->hasMany(DetailPermintaan::class, 'permintaan_id');
    }

}

