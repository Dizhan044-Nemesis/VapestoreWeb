<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Tentukan nama tabel jika berbeda dengan konvensi
    protected $table = 'orders';

    // Tentukan kolom yang dapat diisi massal (mass assignable)
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'category',
        'total_price',
        'status',
        'payment_method',
    ];

    // Tentukan kolom yang harus difilter atau tidak dapat diisi massal
    protected $guarded = ['id'];

    // Tentukan atribut default status (opsional)
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';
 
}
