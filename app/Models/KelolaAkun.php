<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class KelolaAkun extends Model 
{
    use HasFactory;

    protected $table = 'akun'; // Nama tabel di database

    protected $fillable = [
        'nama', 
        'email', 
        'password',
        'role',
    ];
}
