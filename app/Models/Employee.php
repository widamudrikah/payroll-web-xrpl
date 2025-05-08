<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    // Supaya bisa tambah data
    protected $fillable = [
        'user_id',
        'jabatan',
        'gaji_pokok'
    ];

    // Relasi ke tabel user
    public function user() {
        return $this->belongsTo(User::class);
    }
}
