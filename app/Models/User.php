<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'status', 
        'email_verified_at', 'last_login_at', 'remember_token'
    ];
    

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at'     => 'datetime',
    ];

    /**
     * Relasi ke Role (Many to One)
     */
    public function roles()
    {
        return $this->belongsTo(Roles::class, 'role_id'); // sesuai nama model Roles
    }
    
    /**
     * Relasi langsung ke Permission (Many to Many)
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'user_permissions');
    }

    /**
     * Cek apakah user punya permission tertentu
     */
    public function hasPermission($permissionName)
    {
        // Cek permission langsung dari user
        if ($this->permissions()->where('name', $permissionName)->exists()) {
            return true;
        }

        // Cek permission dari role
        if ($this->role && $this->role->permissions()->where('name', $permissionName)->exists()) {
            return true;
        }

        return false;
    }

    /**
     * Cek apakah user punya role tertentu
     */
    public function hasRole($roleName)
    {
        return $this->role && $this->role->name === $roleName;
    }
}