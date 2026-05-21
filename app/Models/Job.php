<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    // Bersihkan daftar mass assignment sesuai kolom tabel MySQL asli kamu
    protected $fillable = [
        'title',
        'company',
        'category',
        'job_type',
        'salary_range',
        'location',
        'deadline_date',
        'description',
        'created_by' // Menggunakan foreign key yang terdaftar di database kamu
    ];

    /**
     * Hubungan relasi ke model User (Pembuat lowongan)
     */
    public function user()
    {
        // Hubungkan ke model User menggunakan foreign key created_by
        return $this->belongsTo(User::class, 'created_by'); 
    }
}