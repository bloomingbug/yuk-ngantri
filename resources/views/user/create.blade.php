@extends('sbadmin.master')

@section('title')
    {{ __('Tambah') }}
@endsection

@section('judul')
    {{ __('Tambah User') }}
@endsection

@section('judulkonten')
    {{ __('Tambah User') }}
@endsection

@section('konten')
    <form action="/users" method="post">
        @csrf
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">@yield('judulkonten')</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        @error('name')
                            <div class="alert alert-danger mx-0">{{ $message }}</div>
                        @enderror
                        @error('email')
                            <div class="alert alert-danger mx-0">{{ $message }}</div>
                        @enderror
                        @error('password')
                            <div class="alert alert-danger mx-0">{{ $message }}</div>
                        @enderror
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" value="{{ old('name') }}" placeholder="Masukan Nama Lengkap" required
                                    autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-sm-2 col-form-label">Role</label>
                            <div class="col-sm-10">
                                <select class="custom-select" id="role" name="role" required>
                                    @if (old('role') == 'admin')
                                        <option value="admin" selected>Admin</option>
                                        <option value="dosen">Dosen</option>
                                        <option value="mahasiswa">Mahasiswa</option>
                                    @elseif (old('role') == 'dosen')
                                        <option value="admin">Admin</option>
                                        <option value="dosen" selected>Dosen</option>
                                        <option value="mahasiswa">Mahasiswa</option>
                                    @elseif (old('role') == 'mahasiswa')
                                        <option value="admin">Admin</option>
                                        <option value="dosen">Dosen</option>
                                        <option value="mahasiswa" selected>Mahasiswa</option>
                                    @else
                                        <option selected hidden disabled>--Pilih Role User--</option>
                                        <option value="admin">Admin</option>
                                        <option value="dosen">Dosen</option>
                                        <option value="mahasiswa">Mahasiswa</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email" value="{{ old('email') }}" placeholder="Masukan alamat email" required
                                    autocomplete="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label text-nowrap">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Masukan Password" required
                                    autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password_confirmation" class="col-sm-2 col-form-label text-nowrap">Konfirmasi
                                Password</label>
                            <div class="col-sm-10">
                                <input type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    id="password_confirmation" name="password_confirmation"
                                    placeholder="Masukan Passowrd Kembali">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @error('jurusan')
                                    <div class="alert alert-danger mx-0">{{ $message }}</div>
                                @enderror
                                @error('kelas')
                                    <div class="alert alert-danger mx-0">{{ $message }}</div>
                                @enderror
                                @error('fakultas')
                                    <div class="alert alert-danger mx-0">{{ $message }}</div>
                                @enderror
                                @error('nim')
                                    <div class="alert alert-danger mx-0">{{ $message }}</div>
                                @enderror
                                <div class="form-group row">
                                    <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nim" name="nim"
                                            value="{{ old('nim') }}" placeholder="Masukan NIM">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="kelas" name="kelas" value="{{ old('kelas') }}"
                                            placeholder="Contoh: TI20A">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jurusan" class="col-sm-2 col-form-label">
                                        <span class="text-nowrap">Program</span>
                                        <span class="text-nowrap">Studi</span>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="jurusan" name="jurusan" value="{{ old('jurusan') }}"
                                            placeholder="Contoh: Teknik Industri">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fakultas" class="col-sm-2 col-form-label">Fakultas</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="fakultas" name="fakultas" value="{{ old('fakultas') }}"
                                            placeholder="Contoh: Fakultas Teknik">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Data Dosen</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @error('nidn')
                                    <div class="alert alert-danger mx-0">{{ $message }}</div>
                                @enderror
                                <div class="form-group row">
                                    <label for="nidn" class="col-sm-2 col-form-label">NIDN</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('nidn') is-invalid @enderror"
                                            id="nidn" name="nidn" value="{{ old('nidn') }}" placeholder="Masukan NIDN">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
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
@endsection
