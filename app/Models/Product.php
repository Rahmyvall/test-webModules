<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Jika nama tabel tidak sesuai konvensi Laravel, bisa ditentukan secara manual
    // protected $table = 'products';

    // Mass assignable fields
    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'price',
        'stock',
        'status',
        'category_id',
    ];

    /**
     * Relasi ke kategori
     */

      // Relasi ke product images
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    // Relasi gambar utama
    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }
    
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    // app/Models/Product.php

    /**
     * Scope untuk produk aktif
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope untuk produk dengan stock tersedia
     */
    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }
}