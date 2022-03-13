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
                    <div class="card-header">{{ __('Tambah user') }}</div>
                    <div class="card-body">
                        <form method="POST" action="#" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="kategori">Nama User</label>
                                <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="isi">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="isi">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="isi">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="password" name="password-confirm"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="isi">Role</label>
                                <select type="text" class="form-control" id="role" name="role" required>
                                    <option value="admin">admin</option>
                                    <option value="editor">editor</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form>
                    </div>
                </div>
                <div class="card mt-5">
                    <div class="card-header">Daftar user</div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Nama</td>
                                    <td>Email</td>
                                    <td>Role</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $i)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $i->name }}</td>
                                        <td>{{ $i->email }}</td>
                                        <td>{{ $i->getRoleNames()->first() }}</td>
                                        <td><button type="button" class="btn text-primary px-1"
                                                data-id="{{ $i->id }}" data-judul="{{ $i->judul }}"
                                                data-isi="{{ $i->isi }}" data-foto="{{ Storage::url($i->foto) }}"
                                                data-toggle="modal" data-target="#modalEdit">
                                                Edit
                                            </button>
                                            <button class="btn text-danger px-1" data-toggle="modal"
                                                data-target="#modalHapus" data-id="{{ $i->id }}"
                                                data-judul="{{ $i->judul }}">
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
    </div>{{-- Modal Edit --}}
    <div class="modal fade modalEdit " id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="formEdit" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="form-group">
                            <label for="kategori">Judul</label>
                            <input type="text" class="form-control" id="judulEdit" aria-describedby="emailHelp"
                                name="judul" required>
                        </div>
                        <div class="form-group">
                            <label for="isi">Isi user</label>
                            <textarea class="form-control" id="isiEdit" rows="3" name="isi" required></textarea>
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Hapus user</h5>
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
                var judul = button.data('judul')
                var isi = button.data('isi')
                var foto = button.data('foto')

                document.getElementById('formEdit').action = 'user/' + id;
                $('#judulEdit').val(judul);
                $('#isiEdit').val(isi);
                document.getElementById("fotoLama").src = foto;
                console.log(foto);

            })
        });
        $(document).ready(function() {
            $('#modalHapus').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var id = button.data('id') // Extract info from data-* attributes
                var judul = button.data('judul')
                var modal = $(this)
                modal.find('.modal-text').text('Hapus user ' + judul + ' ?')
                document.getElementById('formHapus').action = 'user/' + id;
            })
        });
    </script>
@endsection
