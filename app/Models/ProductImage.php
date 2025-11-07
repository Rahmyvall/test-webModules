<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    // Jika nama tabel sesuai konvensi, baris ini opsional
    protected $table = 'product_images';

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'product_id',
        'image_path',
        'alt_text',
        'is_primary',
    ];

    /**
     * Relasi ke produk
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}