@extends('sbadmin.master')

@push('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css" />
@endpush

@section('title')
    {{ __('Sesi Mata Kuliah') }}
@endsection

@section('judul')
    {{ __('Sesi Mata Kuliah') }}
@endsection

@section('judulkonten')
    {{ __('Daftar Sesi Mata Kuliah') }}
@endsection

@section('konten')
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">@yield('judulkonten')</h6>
            @can('admin')
                <a href="/sesi-perkuliahan/create" class="btn btn-primary">Tambah</a>
            @endcan
        </div>
        <!-- Card Body -->
        <div class="card-body table-responsive">
            <table id="myTable" class="table table-bordered table-hover mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>MK</th>
                        <th>Sesi</th>
                        <th>Dosen</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Ruangan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sesiPerkuliahan as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ ucfirst($item->mataKuliah->nama) }}</td>
                            <td>{{ ucfirst($item->nama) }}</td>
                            <td>{{ $item->mataKuliah->dosenPengampu->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->waktuMatkul->tanggal)->isoFormat('dddd, D MMMM Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->waktuMatkul->jam_mulai)->format('H:i') }}
                                {{ __(' - ') }}
                                {{ \Carbon\Carbon::parse($item->waktuMatkul->jam_selesai)->format('H:i') }}</td>
                            <td>{{ $item->waktuMatkul->ruangan->nama }}</td>
                            <td>
                                <div class="d-flex flex-wrap flex-column flex-md-row justify-center">
                                    <form method="POST" action="/sesi-perkuliahan/{{ $item->slug }}">
                                        @csrf
                                        @method('DELETE')
                                        <a href="/matkul/{{ $item->mataKuliah->slug }}" class="btn btn-info btn-sm m-1">
                                            <i class="fa fa-info-circle" aria-hidden="true">
                                            </i>
                                        </a>
                                        <a href="/sesi-perkuliahan/{{ $item->slug }}/edit"
                                            class="btn btn-warning btn-sm m-1">
                                            <i class="fa fa-edit" aria-hidden="true">
                                            </i>
                                        </a>
                                        <button class="btn btn-danger btn-sm m-1 btn-hapus" type="submit"><i
                                                class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <h6 class="text-danger">Data Mata Kuliah Kosong!</h6>
                    @endforelse
                </tbody>
                <tfoot>
                </tfoot>
            </table>
        </div>
    </div>
    </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('sbadmin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
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
