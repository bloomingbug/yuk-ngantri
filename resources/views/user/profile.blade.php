@extends('sbadmin.master')

@section('title')
    {{ __('Profile') }}
@endsection

@section('judul')
    {{ __('Profile') }}
@endsection

@section('judulkonten')
    Profile {{ $user->name }}
@endsection

@section('konten')
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">@yield('judulkonten')</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            @if ($user->role == 'dosen')
                <table class="table table-sm">
                    <tr>
                        <th>Nama</th>
                        <td>:</td>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>NIDN</th>
                        <td>:</td>
                        <td>{{ $user->nidn }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>:</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                </table>
                <a href="{{ URL::previous() }}" class="btn btn-secondary">
                    <i class="fa fa-solid fa-angle-left"></i>
                    <span>Kembali</span>
                </a>
                @if (Auth::user()->slug == $user->slug)
                    <a class="btn btn-primary" href="/users/{{ $user->nidn }}/edit">
                        <i class="fa fa-edit"></i>
                        <span>Edit</span>
                    </a>
                @endif
            @else
                <table class="table table-sm">
                    <tr>
                        <th>Nama</th>
                        <td>:</td>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>NIM</th>
                        <td>:</td>
                        <td>{{ $user->nim }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>:</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Jurusan</th>
                        <td>:</td>
                        <td>{{ $user->jurusan }}</td>
                    </tr>
                    <tr>
                        <th>Kelas</th>
                        <td>:</td>
                        <td>{{ $user->kelas }}</td>
                    </tr>
                    <tr>
                        <th>Fakultas</th>
                        <td>:</td>
                        <td>{{ $user->fakultas }}</td>
                    </tr>
                </table>
                <a href="{{ URL::previous() }}" class="btn btn-secondary">
                    <i class="fa fa-solid fa-angle-left"></i>
                    <span>Kembali</span>
                </a>
                @if (Auth::user()->slug == $user->slug)
                    <a class="btn btn-primary" href="/users/{{ $user->nim }}/edit">
                        <i class="fa fa-edit"></i>
                        <span>Edit</span>
                    </a>
                @endif
            @endif
        </div>
    </div>
    </div>
    </div>
@endsection
