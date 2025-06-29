<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'foto',
        'nama',
        'nim',
        'prodi',
        'fakultas',
        'semester',
        'ringkasan_pribadi',
        'email',
        'organisasi_dan_kepanitiaan',
        'proyek',
        'soft_skills',
        'hard_skills',
        'sertifikat',
        'penghargaan',
        'minat_karier',
        'portofolio',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the profile
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}