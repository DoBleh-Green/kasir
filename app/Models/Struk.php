<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Struk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kasir',
        'items',
        'bayar',
        'total_harga'
    ];

    protected $casts = [
        'items' => 'json',
    ];

}
