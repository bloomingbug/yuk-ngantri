@extends('sbadmin.master')

@push('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css" />
@endpush

@section('title')
    {{ __('Dashboard') }}
@endsection

@section('card')
    @include('sbadmin.partials.card')
@endsection

@section('judul')
    {{ __('Dashboard') }}
@endsection

@section('judulkonten')
    {{ __('Jadwal Perkuliahan') }}
@endsection

@section('konten')
    {{-- Jadwal Kuliah --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center rounded">
            <h6 class="m-0 font-weight-bold text-primary">@yield('judulkonten')</h6>
        </div>
        <div class="card-body table-responsive">

            <table class="table table-bordered table-sm " id="myTable">
                <thead>
                    <tr>
                        <th hidden>No</th>
                        <th scope="col">Hari</th>
                        <th scope="col">Jam</th>
                        <th scope="col">Kode MK</th>
                        <th scope="col">Mata Kuliah</th>
                        <th scope="col">Dosen Pengampu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jadwal as $key => $item)
                        <tr>
                            <td hidden>{{ $key + 1 }}</td>
                            <th>
                                @if ($item->hari == 1)
                                    {{ __('Senin') }}
                                @elseif ($item->hari == 2)
                                    {{ __('Selasa') }}
                                @elseif ($item->hari == 3)
                                    {{ __('Rabu') }}
                                @elseif ($item->hari == 4)
                                    {{ __('Kamis') }}
                                @elseif ($item->hari == 5)
                                    {{ __('Jumat') }}
                                @elseif ($item->hari == 6)
                                    {{ __('Sabtu') }}
                                @else
                                    {{ __('Minggu') }}
                                @endif
                            </th>
                            <td scope="row">
                                {{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }}
                                {{ __(' - ') }}
                                {{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}</td>
                            <td>{{ $item->mataKuliah->kode_mk }}</td>
                            <td>{{ $item->mataKuliah->nama }}</td>
                            <td>{{ $item->mataKuliah->dosenPengampu->name }}</td>
                        </tr>
                    @empty
                        <h4>Jadwal masih kosong</h4>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{-- End of Jadwal Kuliah --}}


    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Kalender Akademik') }}</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-center overflow-hidden w-auto">
                <img src="{{ asset('img/kalender-akademik-2021-2022.jpg') }}" alt="Kalender Akademik 2021/2022"
                    class="img-fluid">
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('sbadmin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endpush
