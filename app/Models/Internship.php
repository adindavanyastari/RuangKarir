<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Internship extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_perusahaan',
        'posisi_magang',
        'deskripsi_pekerjaan',
        'kualifikasi',
        'durasi_magang',
        'lokasi_magang',
        'benefit',
        'deadline_pendaftaran',
        'cara_melamar',
        'kontak_email',
        'kontak_telepon',
        'is_active',
        'created_by'
    ];

    protected $casts = [
        'deadline_pendaftaran' => 'date',
        'is_active' => 'boolean',
    ];

    // Relasi ke User (pembuat)
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Scope untuk internship aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk internship yang belum expired
    public function scopeNotExpired($query)
    {
        return $query->where('deadline_pendaftaran', '>=', now());
    }

    // Accessor untuk status deadline
    public function getIsExpiredAttribute()
    {
        return $this->deadline_pendaftaran < now();
    }
}
