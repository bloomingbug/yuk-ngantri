@extends('sbadmin.master')

@section('title')
    {{ __('Edit') }}
@endsection

@section('judul')
    {{ __('Edit Sesi Mata Kuliah ' . $sesiPerkuliahan->mataKuliah->nama) }}
@endsection

@section('judulkonten')
    {{ __('Edit Sesi Mata Kuliah') }}
@endsection

@section('konten')
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">@yield('judulkonten')</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <form action="/sesi-perkuliahan/{{ $sesiPerkuliahan->slug }}" method="post">
                        @csrf
                        @method('put')

                        @error('nama')
                            <div class="alert alert-danger mx-0">{{ $message }}</div>
                        @enderror
                        @error('kapasitas')
                            <div class="alert alert-danger mx-0">{{ $message }}</div>
                        @enderror
                        @error('mata_kuliah_id')
                            <div class="alert alert-danger mx-0">{{ $message }}</div>
                        @enderror
                        @error('ruangan_id')
                            <div class="alert alert-danger mx-0">{{ $message }}</div>
                        @enderror
                        @error('tanggal')
                            <div class="alert alert-danger mx-0">{{ $message }}</div>
                        @enderror
                        @error('jam_mulai')
                            <div class="alert alert-danger mx-0">{{ $message }}</div>
                        @enderror
                        @error('jam_selesai')
                            <div class="alert alert-danger mx-0">{{ $message }}</div>
                        @enderror
                        @error('status_absen')
                            <div class="alert alert-danger mx-0">{{ $message }}</div>
                        @enderror
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama Sesi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="nama"
                                    name="nama" value="{{ $sesiPerkuliahan->nama }}"
                                    placeholder="Contoh: Sesi Siang/Sesi 1" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kapasitas" class="col-sm-2 col-form-label">Kapasitas</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('kapasitas') is-invalid @enderror"
                                    id="kapasitas" name="kapasitas" value="{{ $sesiPerkuliahan->kapasitas }}"
                                    placeholder="Masukan Kapasitas Sesi" required>
                            </div>
                        </div>
                        {{-- Matkul --}}
                        <input type="text" class="form-control @error('mata_kuliah_id') is-invalid @enderror"
                            id="mata_kuliah_id" name="mata_kuliah_id" value="{{ $sesiPerkuliahan->mataKuliah->id }}"
                            required hidden>
                        {{-- End of Matkul --}}
                        <div class="form-group row">
                            <label for="ruangan_id" class="col-sm-2 col-form-label">Ruangan</label>
                            <div class="col-sm-10">
                                <select class="custom-select" id="ruangan_id" name="ruangan_id" required>
                                    @foreach ($ruangan as $item)
                                        @if ($item->id == $sesiPerkuliahan->waktuMatkul->ruangan->id)
                                            <option value="{{ $item->id }}" selected>{{ $item->nama }}</option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal" class="col-sm-2 col-form-label text-nowrap">Tanggal</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal"
                                    name="tanggal" value="{{ $sesiPerkuliahan->waktuMatkul->tanggal }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jam_mulai" class="col-sm-2 col-form-label text-nowrap">Jam Mulai</label>
                            <div class="col-sm-10">
                                <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror"
                                    id="jam_mulai" name="jam_mulai"
                                    value="{{ $sesiPerkuliahan->waktuMatkul->jam_mulai }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jam_selesai" class="col-sm-2 col-form-label text-nowrap">Jam Selesai</label>
                            <div class="col-sm-10">
                                <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror"
                                    id="jam_selesai" name="jam_selesai"
                                    value="{{ $sesiPerkuliahan->waktuMatkul->jam_selesai }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jam_selesai" class="col-sm-2 col-form-label text-nowrap">Status Absen</label>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_absen" id="aktif"
                                        value="true">
                                    <label class="form-check-label" for="aktif">
                                        Aktif
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_absen" id="tidakAktif"
                                        value="false">
                                    <label class="form-check-label" for="tidakAktif">
                                        Tidak Aktif
                                    </label>
                                </div>
                                @if ($sesiPerkuliahan->status_absen == 1)
                                    <script>
                                        document.getElementById('aktif').checked = true;
                                    </script>
                                @else
                                    <script>
                                        document.getElementById('tidakAktif').checked = true;
                                    </script>
                                @endif
                            </div>
                        </div>


                        <a href="{{ URL::previous() }}" class="btn btn-secondary mt-2">
                            <i class="fa fa-solid fa-angle-left"></i>
                            <span>Kembali</span>
                        </a>
                        <button type="submit" class="btn btn-primary mt-2">
                            <i class="fa fa-solid fa-sd-card"></i>
                            <span>Simpan</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
