<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukKeluar extends Model
{
    use HasFactory;

    protected $table = 'produk_keluar';
    protected $fillable = [
        'user_id', 'id_produk', 'jumlah', 'tanggal', 'created_at', 'updated_at'
    ];

    protected $dates = ['created_at', 'updated_at'];


    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }

    public function user()
    {
    return $this->belongsTo(User::class);
    }
}
