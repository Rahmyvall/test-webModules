<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModuleSetting extends Model
{
    use HasFactory;

    protected $table = 'module_settings';

    /**
     * Kolom yang dapat diisi (mass assignable).
     */
    protected $fillable = [
        'module_name',
        'key',
        'value',
    ];

    /**
     * Ambil setting berdasarkan module dan key.
     *
     * @param string $module
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function getValue(string $module, string $key, $default = null)
    {
        $setting = self::where('module_name', $module)
            ->where('key', $key)
            ->first();

        return $setting ? $setting->value : $default;
    }

    /**
     * Simpan atau perbarui setting modul.
     *
     * @param string $module
     * @param string $key
     * @param mixed $value
     * @return self
     */
    public static function setValue(string $module, string $key, $value)
    {
        return self::updateOrCreate(
            ['module_name' => $module, 'key' => $key],
            ['value' => $value]
        );
    }

    /**
     * Scope untuk filter berdasarkan nama modul.
     */
    public function scopeModule($query, string $module)
    {
        return $query->where('module_name', $module);
    }
}