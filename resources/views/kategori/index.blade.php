@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible show fade" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('error') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">{{ __('Tambah Kategori') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('kategoriSimpan') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="kategori">Nama Kategori</label>
                                <input type="text" class="form-control" id="kategori" aria-describedby="emailHelp"
                                    name="nama">
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form>
                    </div>
                </div>
                <div class="card mt-5">
                    <div class="card-header">Daftar Kategori</div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Nama Kategori</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kategori as $i)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $i->nama }}</td>
                                        <td><button type="button" class="btn text-primary px-1"
                                                data-id="{{ $i->id }}" data-nama="{{ $i->nama }}"
                                                data-toggle="modal" data-target="#modalEdit">
                                                Edit
                                            </button>
                                            <button class="btn text-danger px-1" data-toggle="modal"
                                                data-target="#modalHapus" data-id="{{ $i->id }}"
                                                data-nama="{{ $i->nama }}">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Edit --}}
    <div class="modal fade modalEdit " id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="formEdit" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="form-group ">
                            <label for="exampleInputEmail3">Nama</label>
                            <input name="nama" type="text" class="form-control " id="namaEdit" placeholder="Nama" required>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Edit</button>
                        <button class="btn btn-light" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hapus-->
    <div class="modal fade modalHapus" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="modalHapusTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Hapus Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="formHapus">
                        @method('delete')
                        @csrf
                        <p class="modal-text"></p>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js"
        integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#modalEdit').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var id = button.data('id')
                var nama = button.data('nama')
                document.getElementById('formEdit').action = 'kategori/' + id;
                $('#namaEdit').val(nama);
            })
        });
        $(document).ready(function() {
            $('#modalHapus').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var id = button.data('id') // Extract info from data-* attributes
                var nama = button.data('nama')
                var modal = $(this)
                modal.find('.modal-text').text('Hapus Kategori ' + nama + ' ?')
                document.getElementById('formHapus').action = 'kategori/' + id;
            })
        });
    </script>
@endsection
