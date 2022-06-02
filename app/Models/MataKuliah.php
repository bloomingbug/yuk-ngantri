<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class MataKuliah extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'mata_kuliah';

    protected $fillable = [
        'slug',
        'nama',
        'kode_mk',
        'dosen_pengampu',
        'semester',
    ];

    public function sesiPerkuliahan()
    {
        return $this->hasMany(sesiPerkuliahan::class);
    }

    public function mahasiswaPerkuliahan()
    {
        return $this->hasMany(MahasiswaPerkuliahan::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function dosenPengampu()
    {
        return $this->belongsTo(User::class, 'dosen_pengampu');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'kode_mk',
            ]
        ];
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
}
