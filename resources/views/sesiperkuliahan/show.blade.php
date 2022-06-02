@extends('sbadmin.master')

@section('title')
    {{ __('Sesi') }}
@endsection

@section('judul')
    {{ __('Sesi Perkuliahan') }}
@endsection

@section('judulkonten')
    {{ __('Sesi Mata Kuliah ' . $matkul->nama) }}
@endsection

@section('konten')
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">@yield('judulkonten')</h6>
            @can('dosen')
                <a href="/matkul/{{ $matkul->slug }}/sesi" class="btn btn-primary">
                    Tambah
                </a>
            @endcan
        </div>
        <!-- Card Body -->
        <div class="card-body row">
            <table class="table table-borderless table-sm col-12 col-md-4">
                <tbody>
                    <tr>
                        <th>Dosen Pengampu</th>
                        <td>:</td>
                        <td>{{ $matkul->dosenPengampu->name }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
    </div>
    </div>

    @if (Auth::user()->role == 'mahasiswa')
        @foreach ($sesiPerkuliahan as $item)
            @if ($item->waktuMatkul->tanggal >= $tanggal)
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#collapseCardExample" class="d-block card-header py-3 collapsed" data-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="collapseCardExample">
                        <h6 class="m-0 text-gray-900">
                            {{ $item->nama . ' (' . \Carbon\Carbon::parse($item->waktuMatkul->tanggal)->isoFormat('dddd, D MMMM Y') . ')' }}
                        </h6>

                    </a>

                    <!-- Card Content - Collapse -->
                    <div class="collapse" id="collapseCardExample" style="">
                        <div class="card-body row d-flex align-items-center">
                            <table class="table table-borderless table-sm col-12 col-md-9 mx-2 mx-md-0">
                                <thead>
                                    <tr>
                                        <th>Ruangan</th>
                                        <th>Jam</th>
                                        <th>Kapasitas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $item->waktuMatkul->ruangan->nama }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->waktuMatkul->jam_mulai)->format('H:i') . ' - ' . \Carbon\Carbon::parse($item->waktuMatkul->jam_selesai)->format('H:i') }}
                                        </td>
                                        <td>
                                            <span
                                                class="font-weight-bold
                                                    @if ($item->kapasitas <= $item->pendaftar) {{ 'text-danger' }}
                                                    @else
                                                        {{ 'text-success' }} @endif
                                                        ">{{ $item->pendaftar }}
                                            </span>
                                            <span>/</span>
                                            <span class="font-weight-bold">{{ $item->kapasitas }}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-12 col-md-3 d-flex align-items-center justify-content-center flex-column">
                                <a class="btn btn-secondary w-full col-12 col-md-8 col-xl-6 my-2"
                                    href="/peserta-sesi/{{ $item->slug }}">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                    Lihat
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @else
        @foreach ($sesiPerkuliahan as $item)
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header py-3 collapsed" data-toggle="collapse"
                    role="button" aria-expanded="false" aria-controls="collapseCardExample">
                    <h6 class="m-0 text-gray-900">
                        {{ $item->nama . ' (' . \Carbon\Carbon::parse($item->waktuMatkul->tanggal)->isoFormat('dddd, D MMMM Y') . ')' }}
                    </h6>

                </a>

                <!-- Card Content - Collapse -->
                <div class="collapse" id="collapseCardExample" style="">
                    <div class="card-body row d-flex align-items-center">
                        <table class="table table-borderless table-sm col-12 col-md-9 mx-2 mx-md-0">
                            <thead>
                                <tr>
                                    <th>Ruangan</th>
                                    <th>Jam</th>
                                    <th>Kapasitas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $item->waktuMatkul->ruangan->nama }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->waktuMatkul->jam_mulai)->format('H:i') . ' - ' . \Carbon\Carbon::parse($item->waktuMatkul->jam_selesai)->format('H:i') }}
                                    </td>
                                    <td>
                                        <span
                                            class="
                                @if ($item->kapasitas <= $item->pendaftar) {{ 'text-danger' }}
                                @else
                                    {{ 'text-success' }} @endif
                                ">{{ $item->pendaftar }}</span>
                                        <span>/</span>
                                        <span class="text-font-weight">{{ $item->kapasitas }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="col-12 col-md-3 d-flex align-items-center justify-content-center flex-column">
                            @can('admin')
                                <a class="btn btn-secondary w-full col-12 col-md-8 col-xl-6"
                                    href="/peserta-sesi/{{ $item->slug }}">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                    Lihat
                                </a>
                            @endcan
                            @can('dosen')
                                <form method="POST" action="/sesi-perkuliahan/{{ $item->slug }}" class="w-auto">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-secondary w-full col-12 col-md-8 col-xl-6 left-0"
                                        href="/peserta-sesi/{{ $item->slug }}">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                        Lihat
                                    </a>
                                    <a class="btn btn-warning w-full col-12 col-md-8 col-xl-6 my-2"
                                        href="/sesi-perkuliahan/{{ $item->slug }}/edit">
                                        <i class="fa fa-edit"></i>
                                        Edit
                                    </a>
                                    <button class="btn btn-danger btn-hapus w-full col-12 col-md-8 col-xl-6" type="submit"
                                        data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i>
                                        Hapus
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>

            </div>
        @endforeach
    @endif
@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.btn-hapus').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Hapus Data?`,
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: "warning",
                    buttons: ["Cancel", "Delete"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
@endpush
