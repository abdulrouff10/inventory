<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $fillable = [
        'user_id', 'kode_produk', 'nama_produk', 'id_kategori', 'id_supplier', 'harga', 'foto', 'stok', 'created_at',
        'updated_at',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function supplier()
    {
        return  $this->belongsTo(Supplier::class, 'id_supplier');
    }
    public function kategori()
    {
        return   $this->belongsTo(Kategori::class, 'id_kategori');
    }


    public function produkmasuk()
    {
        return $this->hasMany(ProdukMasuk::class, 'id_produk', 'id');
    }
    public function produkkeluar()
    {
        return $this->hasMany(ProdukKeluar::class, 'id_produk', 'id');
    }

    public function user()
    {
    return $this->belongsTo(User::class);
    }
}
