<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect;
use Alert;

use App\Models\PesertaSesi;
use App\Models\SesiPerkuliahan;
use App\Models\MataKuliah;
use App\Models\User;

class PesertaSesiController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate(
            [
            'user_id' => ['required',],
            'sesi_perkuliahan_id' => ['required',],
        ]
        );



        // Menolak ketika kapasistas penuh
        $sesiPerkuliahan = SesiPerkuliahan::where('id', $request->sesi_perkuliahan_id)->first();

        if ($sesiPerkuliahan->pendaftar == $sesiPerkuliahan->kapasitas) {
            Alert::error('Gagal', 'Sesi sudah penuh');
            return Redirect::back();
        }

        // Menegcek agar tidak daftar sesi 2 kali
        $peserta = PesertaSesi::where('user_id', $request->user_id)->where('sesi_perkuliahan_id', $request->sesi_perkuliahan_id)->get();
        $jumlah = $peserta->count();
        if ($jumlah > 0) {
            Alert::error('Gagal', 'Data sudah ada');
            return Redirect::back();
        }



        DB::table('sesi_perkuliahan')
                        ->where('id', intval($request->sesi_perkuliahan_id))
                        ->update(['pendaftar' => intval($request->pendaftar) + 1]);

        $pesertaSesi = new PesertaSesi;
        $pesertaSesi->user_id = intval($request->user_id);
        $pesertaSesi->sesi_perkuliahan_id = intval($request->sesi_perkuliahan_id);
        $pesertaSesi->absen = 0;

        $pesertaSesi->save();

        toast('Pendaftaran berhasil', 'success');

        return Redirect::back();
    }

    public function show(SesiPerkuliahan $sesiPerkuliahan)
    {
        $pesertaSesi = PesertaSesi::where('sesi_perkuliahan_id', '=', $sesiPerkuliahan->id)
        ->with('user')
        ->orderBy('absen', 'desc')
        ->get();

        return view('pesertasesi.show', ['pesertaSesi' => $pesertaSesi, 'sesiPerkuliahan' => $sesiPerkuliahan]);
    }

    public function edit(PesertaSesi $pesertaSesi)
    {
    }

    public function update(Request $request, PesertaSesi $pesertaSesi)
    {
        if ($pesertaSesi->absen == 1) {
            Alert::error('Gagal', 'Presensi kehadiran telah diisi ');
            return Redirect::back();
        }
        $pesertaSesi->absen = 1;
        $pesertaSesi->update();

        toast('Presensi kehadiran berhasil diisi', 'success');

        return Redirect::back();
    }

    public function destroy(PesertaSesi $pesertaSesi)
    {
        $sesiPerkuliahan = SesiPerkuliahan::where('id', $pesertaSesi->sesi_perkuliahan_id)->first();
        DB::table('sesi_perkuliahan')
                        ->where('id', intval($pesertaSesi->sesi_perkuliahan_id))
                        ->update(['pendaftar' => intval($sesiPerkuliahan->pendaftar) - 1]);

        $pesertaSesi->delete();
        toast('Pendaftaran berhasil dihapus', 'info');

        return Redirect::back();
    }
}
