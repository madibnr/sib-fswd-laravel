<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    
    protected $table = "Produk";
    
    protected $fillable = [
        'id',
        'kategori_id',
        'name',
        'caption',
        'harga',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}

