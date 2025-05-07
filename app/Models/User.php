<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Nama tabel yang digunakan oleh model ini.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Kolom yang bisa diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Kolom yang disembunyikan saat serialisasi.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Kolom yang perlu di-cast ke tipe tertentu.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Kolom yang harus diisi secara otomatis oleh Laravel.
     *
     * @var array
     */
    public $timestamps = true;

    /**
     * Otomatis hash password saat diset.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = strlen($value) === 60 && preg_match('/^\$2y\$/', $value)
            ? $value
            : Hash::make($value);
    }

    /**
     * Override identifikasi login supaya menggunakan `email`.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'email';
    }
}
