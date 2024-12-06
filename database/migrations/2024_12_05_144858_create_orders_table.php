<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Nama pelanggan
            $table->string('email')->nullable(); // Email pelanggan (opsional)
            $table->string('phone'); // Nomor telepon pelanggan
            $table->text('address'); // Alamat pelanggan
            $table->string('category'); // Daftar produk dalam bentuk JSON
            $table->decimal('total_price', 10, 2); // Total harga pesanan
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending'); // Status pesanan
            $table->string('payment_method')->nullable(); // Metode pembayaran
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    } 
};
