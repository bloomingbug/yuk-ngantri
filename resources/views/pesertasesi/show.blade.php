@extends('sbadmin.master')

@push('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
@endpush

@section('title')
    {{ __('Sesi') }}
@endsection

@section('judul')
    {{ __('Sesi Perkuliahan') }}
@endsection

@section('judulkonten')
    {{ __('Pendaftar ' . $sesiPerkuliahan->nama) }}
@endsection

@section('konten')
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">@yield('judulkonten')</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body row">
            <table class="table table-borderless table-sm col-12 col-md-4">
                <tbody>
                    <tr>
                        <th>Mata Kuliah</th>
                        <td>:</td>
                        <td>{{ $sesiPerkuliahan->mataKuliah->nama }}</td>
                    </tr>
                    <tr>
                        <th>Dosen Pengampu</th>
                        <td>:</td>
                        <td>{{ $sesiPerkuliahan->mataKuliah->dosenPengampu->name }}</td>
                    </tr>
                    <tr>
                        <th>Kapasitas</th>
                        <td>:</td>
                        <td>
                            <span
                                class="font-weight-bold
                                                    @if ($sesiPerkuliahan->kapasitas <= $sesiPerkuliahan->pendaftar) {{ 'text-danger' }}
                                                    @else
                                                        {{ 'text-success' }} @endif
                                                        ">{{ $sesiPerkuliahan->pendaftar }}
                            </span>
                            <span>/</span>
                            <span class="font-weight-bold">{{ $sesiPerkuliahan->kapasitas }}</span>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
    </div>
    </div>

    <div class="card shadow mb-4">
        <!-- Card Header - Accordion -->
        <a href="#collapseCardExample" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button"
            aria-expanded="false" aria-controls="collapseCardExample">
            <h6 class="m-0 text-gray-900">
                {{ __('Pendaftar') }}
            </h6>
        </a>

        <!-- Card Content -->
        <div class="card-body table-responsive">

            <table class="table table-bordered" id="myTable">
                <thead>
                    <tr>
                        <th hidden>No</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Kelas</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pesertaSesi as $key => $item)
                        <tr>
                            <td hidden>{{ $key + 1 }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->user->nim }}</td>
                            <td>{{ $item->user->kelas }}</td>
                            <td>
                                @if ($item->absen == 0)
                                    -
                                @else
                                    Hadir
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ URL::previous() }}" class="btn btn-secondary">
                <i class="fa fa-solid fa-angle-left"></i>
                <span>Kembali</span>
            </a>

            <div class="d-flex align-items-center flex-row-reverse">
                @can('mahasiswa')
                    @if ($pesertaSesi->count() == 0)
                        @if ($sesiPerkuliahan->kapasitas > $sesiPerkuliahan->pendaftar)
                            <form action="/peserta-sesi" method="post">
                                @csrf
                                <input type="text" name="sesi_perkuliahan_id" value="{{ $sesiPerkuliahan->id }}" hidden>
                                <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                                <input type="text" name="pendaftar" value="{{ $sesiPerkuliahan->pendaftar }}" hidden>

                                <button type="submit" class="btn btn-success mx-1">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    Daftar
                                </button>
                            </form>
                        @endif
                    @else
                        @foreach ($pesertaSesi as $item)
                            @if ($item->user_id == Auth::user()->id)
                            @else
                                @if ($sesiPerkuliahan->kapasitas > $sesiPerkuliahan->pendaftar)
                                    <form action="/peserta-sesi" method="post">
                                        @csrf
                                        <input type="text" name="sesi_perkuliahan_id" value="{{ $sesiPerkuliahan->id }}"
                                            hidden>
                                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                                        <input type="text" name="pendaftar" value="{{ $sesiPerkuliahan->pendaftar }}" hidden>

                                        <button type="submit" class="btn btn-success mx-1">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                            Daftar
                                        </button>
                                    </form>
                                @endif
                            @endif
                        @endforeach
                    @endif
                    @if ($sesiPerkuliahan->status_absen == 1)
                        @foreach ($pesertaSesi as $item)
                            @if ($item->user_id == Auth::user()->id && $item->absen == 0)
                                <form action="/peserta-sesi/{{ $item->id }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-primary mx-1">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                        Absen
                                    </button>
                                </form>
                            @else
                            @endif
                        @endforeach
                    @endif
                    @foreach ($pesertaSesi as $item)
                        @if ($item->user_id == Auth::user()->id)
                            <a class="btn btn-danger mx-1" href="#" data-toggle="modal" data-target="#deleteModal">
                                <i class="fa fa-trash"></i>
                                Hapus
                            </a>
                        @endif
                    @endforeach
                @endcan
            </div>
        </div>
    </div>
    @if ($sesiPerkuliahan->count() > 0)
        @foreach ($pesertaSesi as $item)
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Yakin dihapus?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Data yang telah dihapus tidak akan bisa dikembalikan!
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button"
                                data-dismiss="modal">{{ __('Cancel') }}</button>

                            <form action="/peserta-sesi/{{ $item->id }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger mx-1">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endsection

@push('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                @can('dosen')
                    dom: 'Bfrtip',
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                @endcan

                @can('admin')
                    dom: 'Bfrtip',
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                @endcan
            });
        });
    </script>
@endpush
