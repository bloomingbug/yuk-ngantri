<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class SesiPerkuliahan extends Model
{
    use HasFactory, sluggable;

    protected $table = 'sesi_perkuliahan';

    protected $fillable = [
        'slug',
        'nama',
        'mata_kuliah_id',
        'waktu_matkul_id',
        'kapasitas',
        'pendaftar',
        'status_absen',
    ];

    protected $casts = [
        'status_absen' => 'boolean',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama',
            ]
        ];
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    }

    public function waktuMatkul()
    {
        return $this->belongsTo(WaktuMatkul::class, 'waktu_matkul_id');
    }

    public function pesertaSesi()
    {
        return $this->hasMany(PesertaSesi::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
