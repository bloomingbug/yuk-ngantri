@extends('sbadmin.master')

@push('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css" />
@endpush

@section('title')
    {{ __('Mata Kuliah') }}
@endsection

@section('judul')
    {{ __('Mata Kuliah') }}
@endsection

@section('judulkonten')
    {{ __('Daftar Mata Kuliah') }}
@endsection

@section('konten')
    @forelse ($matkul as $key => $item)
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">{{ $item->nama }}</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body row">
                <table class="table table-borderless col-12">
                    <tbody>
                        <tr>
                            <th>Kode MK</th>
                            <td>:</td>
                            <td>{{ $item->kode_mk }}</td>
                        </tr>
                        <tr>
                            <th>Dosen Pengampu</th>
                            <td>:</td>
                            <td>{{ $item->dosenPengampu->name }}</td>

                        </tr>
                        <tr>
                            <th>Semester</th>
                            <td>:</td>
                            <td>{{ $item->semester }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="card-footer d-flex flex-row-reverse">
                <a href="/matkul/{{ $item->slug }}" class="btn btn-success">
                    <i class="fa fa-eye"></i>
                    <span>Akses</span>
                </a>
            </div>
        </div>
    @empty
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center rounded">
                <h6 class="m-0 font-weight-bold text-primary">{{ __('Belum ada data') }}</h6>
            </div>
        </div>
    @endforelse
    </div>
    </div>
@endsection
