<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'blog_posts';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'featured_image',
        'status',
        'category_id',
        'author_id',
        'published_at',
        'meta_title',
        'meta_description',
        'tags',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'tags' => 'array', // mengubah JSON tags menjadi array otomatis
    ];

    // Relasi ke kategori
    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    // Relasi ke penulis (user)
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    // Scope untuk memfilter post yang published
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }
}