<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\MataKuliah;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Carbon\Carbon;
use Alert;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::orderBy('hari')->orderBy('jam_mulai')->with(['mataKuliah', 'mataKuliah.dosenPengampu'])->get();
        $jumlah = $jadwal->count();

        if ($jumlah == 0) {
            Alert::info('Data Kosong', 'Data jadwal masih kosong');
        }

        return view('jadwal.index', ['jadwal' => $jadwal]);
    }

    public function create()
    {
        $matkul = MataKuliah::all();
        return view('jadwal.create', ['matkul' => $matkul]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
            'hari' => ['required', 'max:255',],
            'mata_kuliah_id' => ['required', 'exists:App\Models\MataKuliah,id',],
            'jam_mulai' => ['required',],
            'jam_selesai' => ['required',],
        ]
        );

        $kodeMK = MataKuliah::find($request->mata_kuliah_id);
        $slug = SlugService::createSlug(MataKuliah::class, 'slug', $request->hari . '-' . $kodeMK->kode_mk);


        $jadwal = new Jadwal;
        $jadwal->hari = intval($request->hari);
        $jadwal->mata_kuliah_id = $request->mata_kuliah_id;
        $jadwal->jam_mulai = $request->jam_mulai;
        $jadwal->jam_selesai = $request->jam_selesai;
        $jadwal->slug = $slug;

        if ($request->jam_mulai >= $request->jam_selesai) {
            Alert::error('Gagal', 'Jam mulai tidak boleh lebih besar dari jam selesai');
            return redirect()->back();
        }

        $jadwal->save();
        toast('Jadwal berhasil ditambahkan', 'success');
        return redirect('/jadwal');
    }

    public function edit(Jadwal $jadwal)
    {
        $matkul = MataKuliah::all();
        return view('jadwal.edit', [ 'jadwal' => $jadwal, 'matkul' => $matkul]);
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate(
            [
            'hari' => ['required', 'max:255',],
            'mata_kuliah_id' => ['required', 'exists:App\Models\MataKuliah,id',],
            'jam_mulai' => ['required',],
            'jam_selesai' => ['required',],
        ]
        );

        $kodeMK = MataKuliah::find($request->mata_kuliah_id);
        $slug = SlugService::createSlug(MataKuliah::class, 'slug', $request->hari . '-' . $kodeMK->kode_mk);

        $jadwal->hari = intval($request->hari);
        $jadwal->mata_kuliah_id = $request->mata_kuliah_id;
        $jadwal->jam_mulai = $request->jam_mulai;
        $jadwal->jam_selesai = $request->jam_selesai;
        $jadwal->slug = $slug;

        if ($request->jam_mulai >= $request->jam_selesai) {
            Alert::error('Gagal', 'Jam mulai tidak boleh lebih besar dari jam selesai');
            return redirect()->back();
        }

        $jadwal->update();
        toast('Jadwal berhasil diupdate', 'success');
        return redirect('/jadwal');
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        toast('Jadwal berhasil dihapus', 'success');
        return redirect('/jadwal');
    }
}
