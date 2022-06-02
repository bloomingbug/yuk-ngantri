@extends('sbadmin.master')

@push('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css" />
@endpush

@section('title')
    {{ __('Ruangan') }}
@endsection

@section('judul')
    {{ __('Ruangan') }}
@endsection

@section('judulkonten')
    {{ __('Daftar Ruangan') }}
@endsection

@section('konten')
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">@yield('judulkonten')</h6>
            @can('admin')
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">Tambah</a>
            @endcan
        </div>
        <!-- Card Body -->
        <div class="card-body table-responsive">
            <table id="myTable" class="table table-bordered table-hover mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ruangan as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ strtoupper($item->nama) }}</td>
                            <td>
                                <div class="d-flex flex-row">
                                    <a href="/ruangan/{{ $item->slug }}" class="btn btn-info btn-sm m-1">
                                        <i class="fa fa-info-circle" aria-hidden="true">
                                        </i>
                                    </a>
                                    @can('admin')
                                        <form method="POST" action="/ruangan/{{ $item->slug }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm m-1 btn-hapus" type="submit"><i
                                                    class="fa fa-trash"></i></button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <h6 class="text-danger">Data Mata Kuliah Kosong!</h6>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Ruangan</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="/ruangan" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="kode_mk" class="col-sm-4 col-form-label">Nama Ruangan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                        name="nama" value="{{ old('nama') }}" placeholder="Contoh: A309" required
                                        autofocus>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button"
                                data-dismiss="modal">{{ __('Cancel') }}</button>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if ($ruangan->count() > 0)
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
                            <form method="POST" action="/ruangan/{{ $item->slug }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-secondary" type="button"
                                    data-dismiss="modal">{{ __('Cancel') }}</button>

                                <button class="btn btn-danger" type="submit">{{ __('Hapus') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
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
