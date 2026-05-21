<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Lowongan extends Model
{
    use HasFactory;

    protected $table = 'lowongans';

    protected $fillable = [
        'user_id',
        'judul',
        'perusahaan',
        'tipe',
        'bidang',
        'level',
        'lokasi',
        'gaji',
        'deadline',
        'link_lamaran',
        'deskripsi'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relasi ke User
    |--------------------------------------------------------------------------
    | Satu lowongan dimiliki satu user
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}