<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'display_name','description','module_name'];

    /**
     * Relasi ke roles (Many to Many)
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions');
    }

    /**
     * Relasi ke users (Many to Many)
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_permissions');
    }
}