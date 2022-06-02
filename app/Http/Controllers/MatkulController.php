<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Carbon\Carbon;
use Alert;

use App\Models\MataKuliah;
use App\Models\MahasiswaPerkuliahan;
use App\Models\User;
use App\Models\SesiPerkuliahan;
use App\Models\Ruangan;
use App\Models\WaktuKuliah;

class MatkulController extends Controller
{
    public function index()
    {
        $matkul = MataKuliah::orderBy('nama', 'asc')
        ->with('dosenPengampu')
        ->get();
        // dd($matkul);

        $jumlah = $matkul->count();

        if ($jumlah == 0) {
            Alert::info('Data Kosong', 'Data mata kuliah masih kosong');
        }

        return view('matkul.index', ['matkul' => $matkul]);
    }

    public function indexAdmin()
    {
        $matkul = MataKuliah::orderBy('nama', 'asc')
        ->with('dosenPengampu')
        ->get();
        // dd($matkul);
        $jumlah = $matkul->count();

        if ($jumlah == 0) {
            Alert::info('Data Kosong', 'Data mata kuliah masih kosong');
        }

        return view('matkul.index-admin', ['matkul' => $matkul]);
    }

    public function create()
    {
        $dosen = User::where('role', 'dosen')->get();
        return view('matkul.create', ['dosen' => $dosen]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
            'nama' => ['required', 'string', 'max:255',],
            'dosen_pengampu' => ['required', 'exists:App\Models\User,id',],
            'semester' => ['required', 'integer',],
            'kode_mk' => ['required', 'string',],
        ]
        );

        $slug = SlugService::createSlug(MataKuliah::class, 'slug', $request->kode_mk);


        $matkul = new MataKuliah;
        $matkul->nama = $request->nama;
        $matkul->dosen_pengampu = $request->dosen_pengampu;
        $matkul->semester = $request->semester;
        $matkul->kode_mk = $request->kode_mk;
        $matkul->slug = $slug;

        $matkul->save();

        toast('Mata Kuliah ' . $matkul->nama . ' berhasil ditambahkan', 'success');

        return redirect('/matkul-admin');
    }

    public function sesi(MataKuliah $matkul)
    {
        $ruangan = Ruangan::all();
        return view('sesiperkuliahan.create', ['matkul' => $matkul, 'ruangan' => $ruangan]);
    }

    // Menuju ke halaman sesi perkuliahan
    public function show(MataKuliah $matkul)
    {
        $tanggal = Carbon::now()->isoFormat('YYYY-MM-DD');

        $sesiPerkuliahan = SesiPerkuliahan::with(['waktuMatkul', 'waktuMatkul.ruangan'])->where('mata_kuliah_id', $matkul->id)->get();

        return view('sesiperkuliahan.show', ['matkul' => $matkul, 'sesiPerkuliahan' => $sesiPerkuliahan, 'tanggal' => $tanggal]);
    }

    // Menuju ke halaman MK yang Diampu Dosen
    public function showMk(User $user)
    {
        $matkul = MataKuliah::where('dosen_pengampu', $user->id)->get();

        return view('sesiperkuliahan.show-dosen', ['matkul' => $matkul,]);
    }

    public function edit(MataKuliah $matkul)
    {
        $dosen = User::where('role', 'dosen')->get();
        return view('matkul.edit', ['matkul' => $matkul, 'dosen' => $dosen]);
    }

    public function update(Request $request, MataKuliah $matkul)
    {
        $request->validate(
            [
            'nama' => ['required', 'string', 'max:255',],
            'dosen_pengampu' => ['required', 'exists:App\Models\User,id',],
            'semester' => ['required', 'integer',],
            'kode_mk' => ['required', 'string',],
        ]
        );

        $slug = SlugService::createSlug(MataKuliah::class, 'slug', $request->kode_mk);

        $matkul->nama = $request->nama;
        $matkul->dosen_pengampu = $request->dosen_pengampu;
        $matkul->semester = $request->semester;
        $matkul->kode_mk = $request->kode_mk;
        $matkul->slug = $slug;

        $matkul->update();

        toast('Mata Kuliah ' . $matkul->nama . ' berhasil diupdate', 'success');

        return redirect('/matkul-admin');
    }

    public function destroy(MataKuliah $matkul)
    {
        $matkul->delete();
        toast('Mata Kuliah ' . $matkul->nama . ' berhasil dihapus', 'success');
        return redirect('/matkul-admin');
    }
}
