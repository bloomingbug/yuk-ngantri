@extends('sbadmin.master')

@section('title')
    {{ __('Tambah') }}
@endsection

@section('judul')
    {{ __('Tambah Mata Kuliah') }}
@endsection

@section('judulkonten')
    {{ __('Tambah Mata Kuliah') }}
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
                    <form action="/matkul" method="post">
                        @csrf
                        @error('nama')
                            <div class="alert alert-danger mx-0">{{ $message }}</div>
                        @enderror
                        @error('kode_mk')
                            <div class="alert alert-danger mx-0">{{ $message }}</div>
                        @enderror
                        @error('semester')
                            <div class="alert alert-danger mx-0">{{ $message }}</div>
                        @enderror
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="nama"
                                    name="nama" value="{{ old('nama') }}" placeholder="Masukan Nama Mata Kuliah" required
                                    autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kode_mk" class="col-sm-2 col-form-label">Kode Mata Kuliah</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('kode_mk') is-invalid @enderror" id="kode_mk"
                                    name="kode_mk" value="{{ old('kode_mk') }}" placeholder="Masukan Kode Mata Kuliah"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dosen_pengampu" class="col-sm-2 col-form-label">Dosen Pengampu</label>
                            <div class="col-sm-10">
                                <select class="custom-select" id="dosen_pengampu" name="dosen_pengampu"
                                    value="{{ old('dosen_pengampu') }}" required>
                                    <option selected hidden disabled>--Pilih Dosen Pengampu--</option>
                                    @foreach ($dosen as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="semester" class="col-sm-2 col-form-label text-nowrap">Semester</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control @error('semester') is-invalid @enderror"
                                    id="semester" name="semester" value="{{ old('semester') }}"
                                    placeholder="Semester mata kuliah..." required>
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
