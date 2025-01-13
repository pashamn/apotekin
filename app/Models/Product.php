<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description',
        'image', // Tambahkan atribut ini jika ada kolom untuk menyimpan URL/path gambar
        'category_id', // Tambahkan atribut ini untuk relasi kategori
    ];

    // Relasi ke model Categories
    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
