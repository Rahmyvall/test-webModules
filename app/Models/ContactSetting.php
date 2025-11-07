<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSetting extends Model
{
    use HasFactory;

    protected $table = 'contact_settings';

    // Kolom yang bisa diisi massal
    protected $fillable = [
        'key',
        'value',
    ];
}