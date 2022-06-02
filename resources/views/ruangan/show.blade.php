@extends('sbadmin.master')

@section('title')
    {{ __('Ruangan') }}
@endsection

@section('judul')
    {{ __('Ruangan') }}
@endsection

@section('judulkonten')
    {{ __('Info Ruangan ' . $ruangan->nama) }}
@endsection

@section('konten')
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">@yield('judulkonten')</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body table-responsive">
            <table id="myTable" class="table table-borderless table-hover mt-3">
                <thead>
                    <tr>
                        <th hidden>No</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Mata Kuliah</th>
                        <th>Dosen Pengampu</th>
                        <th>Kapasitas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sesi as $key => $item)
                        <tr>
                            <td hidden>{{ $key + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->waktuMatkul->tanggal)->isoFormat('dddd, D MMM Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->waktuMatkul->jam_mulai)->format('H:i') }}
                                {{ __(' - ') }}
                                {{ \Carbon\Carbon::parse($item->waktuMatkul->jam_selesai)->format('H:i') }}
                            </td>
                            <td>{{ $item->mataKuliah->nama }}</td>
                            <td>{{ $item->mataKuliah->dosenPengampu->name }}</td>
                            <td><span
                                    class="font-weight-bold
                                        @if ($item->kapasitas <= $item->pendaftar) {{ 'text-danger' }}
                                        @else
                                            {{ 'text-success' }} @endif
                                        ">{{ $item->pendaftar }}</span>
                                <span>/</span>
                                <span class="font-weight-bold">{{ $item->kapasitas }}</span>
                            </td>
                        </tr>
                    @empty
                        <h6 class="text-danger">Data User Kosong!</h6>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            <a href="{{ URL::previous() }}" class="btn btn-secondary mt-2 mr-3">
                <i class="fa fa-solid fa-angle-left"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>
    </div>
    </div>
@endsection
