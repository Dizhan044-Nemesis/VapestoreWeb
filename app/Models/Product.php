<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Tabel yang terkait dengan model ini.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'category',
        'description',
        'price',
        'stock',
    ];

    /**
     * Atribut yang disembunyikan saat serialisasi.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Atribut yang harus di-cast ke tipe data tertentu.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];
}
