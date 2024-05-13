<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks';

    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'deskripsi',
        'image',
        'price',
        'stock',
        'category',
        'is_best_seller',
    ];
}
