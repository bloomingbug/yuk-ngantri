<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageContainer extends Model
{
    use HasFactory;

    protected $table = 'image_container';
    protected $fillable = [
        'slug', 'nama', 'img'
    ];
}
