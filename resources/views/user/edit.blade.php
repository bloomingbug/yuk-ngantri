@extends('sbadmin.master')

@section('title')
    {{ __('Edit') }}
@endsection

@section('judul')
    {{ __('Edit') }}
@endsection

@section('judulkonten')
    Edit Data {{ $user->name }}
@endsection

@section('konten')
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">@yield('judulkonten')</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            @if (Auth::user()->slug == $user->slug)
                @if (session('lengkapi'))
                    <div class="alert alert-warning">
                        {{ session('lengkapi') }}
                    </div>
                @endif
                <form action="/users/{{ $user->nim }}" method="post">
                    @csrf
                    @method('PUT')
                    @error('name')
                        <div class="alert alert-danger mx-0">{{ $message }}</div>
                    @enderror
                    @error('jurusan')
                        <div class="alert alert-danger mx-0">{{ $message }}</div>
                    @enderror
                    @error('kelas')
                        <div class="alert alert-danger mx-0">{{ $message }}</div>
                    @enderror
                    @error('fakultas')
                        <div class="alert alert-danger mx-0">{{ $message }}</div>
                    @enderror
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ $user->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nim" value="{{ $user->nim }}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" value="{{ $user->email }}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="jurusan"
                                name="jurusan" value="{{ $user->jurusan }}" placeholder="Contoh: Teknik Industri">
                        </div>
                        @error('jurusan')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="kelas"
                                name="kelas" value="{{ $user->kelas }}" placeholder="Contoh: TI20A">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fakultas" class="col-sm-2 col-form-label">Fakultas</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="fakultas"
                                name="fakultas" value="{{ $user->fakultas }}" placeholder="Fakultas Teknik">
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
            @else
                @php
                    header('Location: ' . URL::to('/users' . '/' . Auth::user()->slug), true, 302);
                    exit();
                @endphp
            @endif
        </div>
    </div>
    </div>
    </div>
@endsection
