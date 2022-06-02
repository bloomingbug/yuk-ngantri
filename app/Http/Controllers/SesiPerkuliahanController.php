<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Carbon\Carbon;

use App\Models\SesiPerkuliahan;
use App\Models\MataKuliah;
use App\Models\Ruangan;
use App\Models\WaktuMatkul;
use Alert;

class SesiPerkuliahanController extends Controller
{
    public function index()
    {
        $sesiPerkuliahan = SesiPerkuliahan::with(['mataKuliah', 'waktuMatkul', 'waktuMatkul.ruangan'])->get();
        $jumlah = $sesiPerkuliahan->count();

        if ($jumlah == 0) {
            Alert::info('Data Kosong', 'Data sesi perkuliahan masih kosong');
        }

        return view('sesiperkuliahan.index', [
            'sesiPerkuliahan' => $sesiPerkuliahan,
        ]);
    }

    public function create()
    {
        return view('sesiperkuliahan.create-admin', [
            'mataKuliah' => MataKuliah::all(),
            'ruangan' => Ruangan::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
            'nama' => ['required', 'string', 'max:255',],
            'mata_kuliah_id' => ['required', 'exists:App\Models\MataKuliah,id',],
            'ruangan_id' => ['required', 'exists:App\Models\Ruangan,id',],
            'kapasitas' => ['required', 'integer',],
            'status_absen' => ['required',],
            'tanggal' => ['required',],
            'jam_mulai' => ['required',],
            'jam_selesai' => ['required',],
        ]
        );

        $sekarang = Carbon::now();
        $tanggal = Carbon::parse($request->tanggal)->isoFormat('YYYY-MM-DD');

        $waktuKuliah = WaktuMatkul::where('tanggal', '=', $tanggal)->where('ruangan_id', '=', $request->ruangan_id)->get();
        foreach ($waktuKuliah as $key => $waktu) {
            if (($request->jam_mulai <= Carbon::parse($waktu->jam_mulai)->isoFormat('HH:mm') &&
                $request->jam_selesai >= Carbon::parse($waktu->jam_mulai)->isoFormat('HH:mm'))
                ||
                ($request->jam_mulai < Carbon::parse($waktu->jam_selesai)->isoFormat('HH:mm') &&
                $request->jam_selesai > Carbon::parse($waktu->jam_selesai)->isoFormat('HH:mm'))) {
                Alert::error('Gagal', 'Jam perkuliahan tidak boleh sama atau berada diantara jam perkuliahan yang sudah ada');
                return redirect()->back();
            }
        };

        if ($request->jam_mulai >= $request->jam_selesai) {
            Alert::error('Gagal', 'Jam mulai tidak boleh lebih besar dari jam selesai');
            return redirect()->back();
        } elseif ($request->tanggal < Carbon::parse($sekarang)->isoFormat('YYYY-MM-DD')) {
            Alert::error('Gagal', 'Tanggal tidak boleh lebih kecil dari tanggal hari ini');
            return redirect()->back();
        }

        $status_absen = $request->status_absen === "true" ? 1 : 0;
        $slug = SlugService::createSlug(SesiPerkuliahan::class, 'slug', $request->tanggal . '-' . $request->nama);

        $arrayWaktuMatkul = [
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'ruangan_id' => $request->ruangan_id,
            'created_at' => $sekarang,
            'updated_at' => $sekarang,
        ];
        $waktuMatkul   = DB::table('waktu_matkul')->insertGetId($arrayWaktuMatkul);

        $arraySesiPerkuliahan = [
            'nama' => $request->nama,
            'mata_kuliah_id' => $request->mata_kuliah_id,
            'waktu_matkul_id' => $waktuMatkul,
            'kapasitas' => $request->kapasitas,
            'pendaftar' => 0,
            'status_absen' => $status_absen,
            'slug' => $slug,
            'created_at' => $sekarang,
            'updated_at' => $sekarang,
        ];
        $sesiPerkuliahan   = DB::table('sesi_perkuliahan')->insertGetId($arraySesiPerkuliahan);

        $matkul = MataKuliah::where('id', $request->mata_kuliah_id)->first();
        toast('Sesi perkuliahan pada mata kuliah ' . $matkul->nama . ' berhasil ditambahkan', 'success');
        return redirect("/matkul" . "/" . $matkul->slug);
    }

    public function show($id)
    {
        //
    }

    public function edit(SesiPerkuliahan $sesiPerkuliahan)
    {
        return view('sesiperkuliahan.edit', ['sesiPerkuliahan' => $sesiPerkuliahan,
            'mataKuliah' => MataKuliah::all(),
            'ruangan' => Ruangan::all(),
        ]);
    }

    public function update(Request $request, SesiPerkuliahan $sesiPerkuliahan)
    {
        $request->validate(
            [
            'nama' => ['required', 'string', 'max:255',],
            'mata_kuliah_id' => ['required', 'exists:App\Models\MataKuliah,id',],
            'ruangan_id' => ['required', 'exists:App\Models\Ruangan,id',],
            'kapasitas' => ['required', 'integer',],
            'status_absen' => ['required',],
            'tanggal' => ['required',],
            'jam_mulai' => ['required',],
            'jam_selesai' => ['required',],
        ]
        );

        $sekarang = Carbon::now();
        $tanggal = Carbon::parse($request->tanggal)->isoFormat('YYYY-MM-DD');

        $waktuKuliah = WaktuMatkul::where('tanggal', '>=', $tanggal)->where('ruangan_id', '=', $request->ruangan_id)->whereNotIn('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
        ->whereNotIn('id', [$request->waktu_matkul_id])
        ->get();
        foreach ($waktuKuliah as $key => $waktu) {
            if (($request->jam_mulai <= Carbon::parse($waktu->jam_mulai)->isoFormat('HH:mm') && $request->jam_selesai >= Carbon::parse($waktu->jam_mulai)->isoFormat('HH:mm')) || ($request->jam_mulai < Carbon::parse($waktu->jam_selesai)->isoFormat('HH:mm') && $request->jam_selesai > Carbon::parse($waktu->jam_selesai)->isoFormat('HH:mm'))) {
                Alert::error('Gagal', 'Jam perkuliahan tidak boleh sama atau berada diantara jam perkuliahan yang sudah ada');
                return redirect()->back();
            }
        };

        if ($request->jam_mulai >= $request->jam_selesai) {
            Alert::error('Gagal', 'Jam mulai tidak boleh lebih besar dari jam selesai');
            return redirect()->back();
        } elseif ($request->tanggal < Carbon::parse($sekarang)->isoFormat('YYYY-MM-DD')) {
            Alert::error('Gagal', 'Tanggal tidak boleh lebih kecil dari tanggal hari ini');
            return redirect()->back();
        }

        $status_absen = $request->status_absen === "true" ? 1 : 0;
        $slug = SlugService::createSlug(SesiPerkuliahan::class, 'slug', $request->tanggal . '-' . $request->nama);

        $arrayWaktuMatkul = [
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'ruangan_id' => $request->ruangan_id,
            'updated_at' => $sekarang,
        ];
        $waktuMatkul   = DB::table('waktu_matkul')->where('id', $sesiPerkuliahan->waktu_matkul_id)->update($arrayWaktuMatkul);

        $arraySesiPerkuliahan = [
            'nama' => $request->nama,
            'kapasitas' => $request->kapasitas,
            'status_absen' => $status_absen,
            'slug' => $slug,
            'updated_at' => $sekarang,
        ];
        $sesiPerkuliahan   = DB::table('sesi_perkuliahan')->where('id', $sesiPerkuliahan->id)->update($arraySesiPerkuliahan);

        $matkul = MataKuliah::where('id', $request->mata_kuliah_id)->first();
        toast('Sesi perkuliahan pada mata kuliah ' . $matkul->nama . ' berhasil diupdate', 'success');
        return redirect("/matkul" . "/" . $matkul->slug);
    }

    public function destroy(SesiPerkuliahan $sesiPerkuliahan)
    {
        $waktuMatkul = WaktuMatkul::where('id', $sesiPerkuliahan->waktu_matkul_id)->first();
        $waktuMatkul->delete();
        $sesiPerkuliahan->delete();
        toast($sesiPerkuliahan->nama . ' berhasil dihapus', 'info');
        $matkul = MataKuliah::where('id', $sesiPerkuliahan  ->mata_kuliah_id)->first();
        return redirect("/matkul" . "/" . $matkul->slug);
    }
}
