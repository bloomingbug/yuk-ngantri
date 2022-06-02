<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Carbon\Carbon;
use Alert;

use App\Models\Ruangan;
use App\Models\WaktuMatkul;
use App\Models\SesiPerkuliahan;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangan = Ruangan::all();
        $jumlah = $ruangan->count();
        if ($jumlah == 0) {
            Alert::info('Data Kosong', 'Data mata kuliah masih kosong');
        }

        return view('ruangan.index', ['ruangan' => $ruangan]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
            'nama' => ['required', 'string', 'max:255',]
        ]
        );

        $slug = SlugService::createSlug(Ruangan::class, 'slug', $request->nama);

        $ruangan = new Ruangan;
        $ruangan->nama = $request->nama;
        $ruangan->slug = $slug;

        $ruangan->save();

        toast('Ruangan ' . $ruangan->nama . ' berhasil ditambahkan', 'success');

        return redirect('/ruangan');
    }

    public function show(Ruangan $ruangan)
    {
        $sekarang = Carbon::now();
        $tanggal = Carbon::parse($sekarang)->isoFormat('YYYY-MM-DD');

        $sesi = SesiPerkuliahan::whereRelation('waktuMatkul', 'tanggal', '>=', $tanggal)
        ->whereRelation('waktuMatkul', 'ruangan_id', '=', $ruangan->id)
        ->with(['waktuMatkul', 'waktuMatkul.ruangan', 'mataKuliah'])
        ->get();

        $jumlah = $sesi->count();
        if ($jumlah == 0) {
            Alert::info('Data Kosong', 'Belum ada jadwal penggunaan ruangan');
        }

        return view('ruangan.show', ['ruangan' => $ruangan ,'sesi' => $sesi]);
    }

    public function destroy(Ruangan $ruangan)
    {
        $ruangan->delete();
        toast('Ruangan ' . $ruangan->nama . ' berhasil dihapus', 'success');
        return redirect('/ruangan');
    }
}
