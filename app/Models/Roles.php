<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends Model
{
    use HasFactory;

    protected $table = 'roles'; // tetap pakai nama tabel roles

    protected $fillable = [
        'name',
        'display_name',
        'description',
        'status',
    ];
    
    public function roles()
    {
        return $this->belongsTo(Roles::class);
    }


    /**
     * Relasi ke tabel users (One To Many)
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Relasi ke tabel permissions (Many To Many)
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }

    /**
     * Helper untuk menampilkan nama tampilan (display name)
     */
    public function getLabelAttribute(): string
    {
        return $this->display_name ?: ucfirst($this->name);
    }
}