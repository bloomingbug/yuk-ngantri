<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Ruangan extends Model
{
    use HasFactory, sluggable;

    protected $table = 'ruangan';

    protected $fillable = [
        'nama',
        'slug',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama',
            ]
        ];
    }

    public function waktuMatkul()
    {
        return $this->hasMany(WaktuMatkul::class);
    }
}
