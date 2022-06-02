<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaktuMatkul extends Model
{
    use HasFactory;

    protected $table = 'waktu_matkul';

    protected $fillable = [
        'ruangan_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
    ];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    public function sesiPerkuliahan()
    {
        return $this->hasOne(SesiPerkuliahan::class);
    }
}
