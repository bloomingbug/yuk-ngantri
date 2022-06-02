<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\MataKuliah;
use App\Models\Jadwal;

class HomeController extends Controller
{
    public function index()
    {
        $matkul = MataKuliah::all()->count();
        $dosen = User::where('role', 'dosen')->count();
        $mahasiswa = User::where('role', 'mahasiswa')->count();

        $jadwal = Jadwal::orderBy('hari')->orderBy('jam_mulai')->with(['mataKuliah', 'mataKuliah.dosenPengampu'])->get();
        $jumlah = $jadwal->count();

        if ($jumlah == 0) {
            Alert::info('Data Kosong', 'Data jadwal masih kosong');
        }

        return view('dashboard', ['dosen' => $dosen, 'jadwal' => $jadwal, 'mahasiswa' => $mahasiswa, 'matkul' => $matkul, ]);
    }
}
