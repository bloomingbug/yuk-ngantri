<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaSesi extends Model
{
    use HasFactory;

    protected $table = 'peserta_sesi';

    protected $fillable = ['user_id', 'sesi_perkuliahan_id', 'absen',];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sesiPerkuliahan()
    {
        return $this->belongsTo(SesiPerkuliahan::class, 'sesi_perkuliahan_id');
    }
}
