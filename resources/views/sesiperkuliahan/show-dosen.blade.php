@extends('sbadmin.master')

@section('title')
    {{ __('Mata Kuliah') }}
@endsection

@section('judul')
    {{ __('Mata Kuliah') }}
@endsection

@section('judulkonten')
    {{ __('Mata Kuliah') }}
@endsection

@section('konten')
    @foreach ($matkul as $key => $item)
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">@yield('judulkonten') {{ ' ' . $key + 1 }}</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body row">
                <table class="table table-borderless table-sm col-12 col-md-6">
                    <tbody>
                        <tr>
                            <th>Kode MK</th>
                            <td>:</td>
                            <td>{{ $item->kode_mk }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>:</td>
                            <td>{{ $item->nama }}</td>
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
    @endforeach
    </div>
    </div>
@endsection
