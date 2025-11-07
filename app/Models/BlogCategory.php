<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogCategory extends Model
{
    use HasFactory;

    // Nama tabel (opsional jika sama dengan plural model)
    protected $table = 'blog_categories';

    // Kolom yang bisa diisi massal
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    protected $casts = [
      'is_active' => 'boolean',
  ];
  

    /**
     * Boot model events.
     * Membuat slug otomatis dari name jika belum diisi.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function ($category) {
            if ($category->isDirty('name')) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    /**
     * Contoh relasi ke tabel Blog (jika ada).
     */
    
}