@extends('sbadmin.master')

@section('title')
    {{ __('Tambah') }}
@endsection

@section('judul')
    {{ __('Tambah Jadwal') }}
@endsection

@section('judulkonten')
    {{ __('Tambah Jadwal') }}
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
                    <form action="/jadwal" method="post">
                        @csrf
                        @error('hari')
                            <div class="alert alert-danger mx-0">{{ $message }}</div>
                        @enderror
                        @error('mata_kuliah_id')
                            <div class="alert alert-danger mx-0">{{ $message }}</div>
                        @enderror
                        @error('jam_mulai')
                            <div class="alert alert-danger mx-0">{{ $message }}</div>
                        @enderror
                        @error('jam_selesai')
                            <div class="alert alert-danger mx-0">{{ $message }}</div>
                        @enderror
                        <div class="form-group row">
                            <label for="hari" class="col-sm-2 col-form-label">Hari</label>
                            <div class="col-sm-10">
                                <select class="custom-select" id="hari" name="hari" required autofocus>
                                    <option selected hidden disabled>--Pilih Hari--</option>
                                    <option value="1">Senin</option>
                                    <option value="2">Selasa</option>
                                    <option value="3">Rabu</option>
                                    <option value="4">Kamis</option>
                                    <option value="5">Jumat</option>
                                    <option value="6">Sabtu</option>
                                    <option value="7">Minggu</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mata_kuliah_id" class="col-sm-2 col-form-label">Mata Kuliah</label>
                            <div class="col-sm-10">
                                <select class="custom-select" id="mata_kuliah_id" name="mata_kuliah_id"
                                    value="{{ old('mata_kuliah_id') }}" required>
                                    <option selected hidden disabled>--Pilih Mata Kuliah--</option>
                                    @foreach ($matkul as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->nama }}{{ __(' - ') }}{{ $item->dosenPengampu->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jam_mulai" class="col-sm-2 col-form-label">Jam Mulai</label>
                            <div class="col-sm-10">
                                <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror"
                                    id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai') }}"
                                    placeholder="Contoh: 08:00" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jam_selesai" class="col-sm-2 col-form-label">Jam Selesai</label>
                            <div class="col-sm-10">
                                <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror"
                                    id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai') }}"
                                    placeholder="Contoh: 10:00" required>
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
