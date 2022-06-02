@extends('sbadmin.master')

@push('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css" />
@endpush

@section('title')
    {{ __('Jadwal') }}
@endsection

@section('judul')
    {{ __('Jadwal') }}
@endsection

@section('judulkonten')
    {{ __('Setting Jadwal') }}
@endsection

@section('konten')
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">@yield('judulkonten')</h6>
            @can('admin')
                <a href="/jadwal/create" class="btn btn-primary">Tambah</a>
            @endcan
        </div>
        <!-- Card Body -->
        <div class="card-body table-responsive">
            <table id="myTable" class="table table-bordered table-hover mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Mata Kuliah</th>
                        <th>Dosen Pengampu</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jadwal as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
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
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }} {{ __(' - ') }}
                                {{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}
                            </td>
                            <td>{{ $item->mataKuliah->nama }}</td>
                            <td>{{ $item->mataKuliah->dosenPengampu->name }}</td>
                            <td>
                                <div class="d-flex flex-wrap flex-column flex-md-row justify-center">
                                    <form method="POST" action="/jadwal/{{ $item->slug }}" class="m-0 p-0">
                                        @csrf
                                        @method('DELETE')
                                        <a href="/jadwal/{{ $item->slug }}/edit" class="btn btn-warning btn-sm m-1">
                                            <i class="fa fa-edit" aria-hidden="true">
                                            </i>
                                        </a>
                                        <button class="btn btn-danger btn-hapus btn-sm m-1" type="submit"
                                            data-toggle="tooltip" data-placement="top" title="Delete"><i
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
