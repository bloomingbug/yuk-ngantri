<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Jadwal extends Model
{
    use HasFactory, sluggable;

    protected $table = 'jadwal';

    protected $fillable = [
        'mata_kuliah_id',
        'slug',
        'hari',
        'jam_mulai',
        'jam_selesai',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'hari',
            ]
        ];
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    }

}
