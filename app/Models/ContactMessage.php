<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactMessage extends Model
{
    use HasFactory, SoftDeletes;

    // Nama tabel (opsional jika sesuai konvensi Laravel)
    protected $table = 'contact_messages';

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'status',
        'ip_address',
        'user_agent',
        'phone',
        'is_read',
    ];

    // Casting tipe data
    protected $casts = [
        'is_read' => 'boolean',
    ];

    /**
     * Scope untuk pesan baru
     */
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    /**
     * Scope untuk pesan yang sudah dibalas
     */
    public function scopeReplied($query)
    {
        return $query->where('status', 'replied');
    }

    /**
     * Scope untuk pesan yang diarsipkan
     */
    public function scopeArchived($query)
    {
        return $query->where('status', 'archived');
    }
}