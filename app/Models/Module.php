<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $table = 'modules';

    protected $fillable = [
        'name',
        'display_name',
        'description',
        'version',
        'status',
        'installed_at',
    ];

    protected $casts = [
        'installed_at' => 'datetime',
    ];

    protected $attributes = [
        'status' => 'inactive',
    ];
}