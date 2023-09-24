@extends('layouts.main')

@section('header')
<div class="d-flex justify-content-between align-items-center mx-3 mt-5">
    <h1 class="m-0">Data Siswa</h1>
</div><!-- /.row -->
@endsection


@section('content')
<section class="container mx-auto mt-5">
    <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#createModal">
        Tambah Siswa
    </button>
    @if (session('success'))
        <div class="bg bg-success w-100 p-3">
            {{session('success')}}
        </div>
    @endif
    <table class="table" style="overflow-x: auto">
        <thead>
            <tr>
                <th scope="col" class="text-center">Nomor</th>
                <th scope="col" class="text-center">NISN</th>
                <th scope="col" class="text-center">Nama</th>
                <th scope="col" class="text-center">Kelas</th>
                <th scope="col" class="text-center">Alamat</th>
                <th scope="col" class="text-center">Nama Ortu</th>
                <th scope="col" class="text-center">Email Ortu</th>
                <th scope="col" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data['siswa'] as $item)
            <tr>
                <th scope="row" class="text-center">{{$loop->iteration}}</th>
                <td class="text-center"><small>{{$item->nisn}}</small></td>
                <td class="text-center"><small>{{$item->nama_siswa}}</small></td>
                <td class="text-center"><small>{{$item->kelas}}</small></td>
                <td class="text-center"><small>{{$item->alamat}}</small></td>
                <td class="text-center"><small>{{$item->nama_ortu}}</small></td>
                <td class="text-center"><small>{{$item->email_ortu}}</small></td>
                <td class="text-center">
                    <button type="button" class="btn btn-warning mb-2" data-toggle="modal" data-target="#editModal{{$item->nisn}}">
                        <i class="fa fa-edit text-light"></i>
                    </button>
                    <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#deleteModal{{$item->nisn}}">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>

            <!-- Modal -->
            <div class="modal fade" id="editModal{{$item->nisn}}" tabindex="-1" aria-labelledby="editModal{{$item->nisn}}Label"
                aria-hidden="true">
                <form action="{{route('siswa.update')}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="nisn" value="{{$item->nisn}}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModal{{$item->nisn}}Label">Tambah Siswa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nisn" class="form-label">NISN</label>
                                    <input required type="number" class="form-control" id="nisn" name="nisn"
                                        placeholder="Masukkan nisn siswa" value="{{$item->nisn}}">
                                </div>
                                <div class="form-group">
                                    <label for="nama_siswa" class="form-label">Nama</label>
                                    <input required type="text" class="form-control" id="nama_siswa" name="nama_siswa"
                                        placeholder="Masukkan nama siswa" value="{{$item->nama_siswa}}">
                                </div>
                                <div class="form-group">
                                    <label for="kelas" class="form-label">Kelas</label>
                                    <input required type="text" class="form-control" id="kelas" name="kelas"
                                        placeholder="Masukkan kelas siswa" value="{{$item->kelas}}">
                                </div>
                                <div class="form-group">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input required type="text" class="form-control" id="alamat" name="alamat"
                                        placeholder="Masukkan alamat siswa" value="{{$item->alamat}}">
                                </div>
                                <div class="form-group">
                                    <label for="nama_ortu" class="form-label">Nama Ortu</label>
                                    <input required type="text" class="form-control" id="nama_ortu" name="nama_ortu"
                                        placeholder="Masukkan nama ortu siswa" value="{{$item->nama_ortu}}">
                                </div>
                                <div class="form-group">
                                    <label for="email_ortu" class="form-label">Email Ortu</label>
                                    <input required type="email" class="form-control" id="email_ortu" name="email_ortu"
                                        placeholder="Masukkan email ortu siswa" value="{{$item->email_ortu}}">
                                </div>
                                <div class="form-group">
                                    <label for="password_siswa" class="form-label">Password Siswa</label>
                                    <input type="password" class="form-control" id="password_siswa"
                                        name="password_siswa" placeholder="Masukkan password siswa">
                                </div>
                                <div class="form-group">
                                    <label for="password_orangtua" class="form-label">Password Ortu</label>
                                    <input type="password" class="form-control" id="password_orangtua"
                                        name="password_orangtua" placeholder="Masukkan password ortu siswa">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="deleteModal{{$item->nisn}}" tabindex="-1" aria-labelledby="deleteModal{{$item->nisn}}Label"
                aria-hidden="true">
                <form action="{{route('siswa.delete')}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="nisn" value="{{$item->nisn}}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModal{{$item->nisn}}Label">Hapus Siswa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Siswa <strong>{{$item->nama_siswa}}</strong> akan dihapus</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Hapus</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @empty
            <tr>
                <th scope="row" colspan="7" class="text-center">Absensi tidak ditemukan</th>
            </tr>
            @endforelse

        </tbody>
    </table>
</section>

<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <form action="{{route('siswa.store')}}" method="POST">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nisn" class="form-label">NISN</label>
                        <input required type="number" class="form-control" id="nisn" name="nisn"
                            placeholder="Masukkan nisn siswa">
                    </div>
                    <div class="form-group">
                        <label for="nama_siswa" class="form-label">Nama</label>
                        <input required type="text" class="form-control" id="nama_siswa" name="nama_siswa"
                            placeholder="Masukkan nama siswa">
                    </div>
                    <div class="form-group">
                        <label for="kelas" class="form-label">Kelas</label>
                        <input required type="text" class="form-control" id="kelas" name="kelas"
                            placeholder="Masukkan kelas siswa">
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input required type="text" class="form-control" id="alamat" name="alamat"
                            placeholder="Masukkan alamat siswa">
                    </div>
                    <div class="form-group">
                        <label for="nama_ortu" class="form-label">Nama Ortu</label>
                        <input required type="text" class="form-control" id="nama_ortu" name="nama_ortu"
                            placeholder="Masukkan nama ortu siswa">
                    </div>
                    <div class="form-group">
                        <label for="email_ortu" class="form-label">Email Ortu</label>
                        <input required type="email" class="form-control" id="email_ortu" name="email_ortu"
                            placeholder="Masukkan email ortu siswa">
                    </div>
                    <div class="form-group">
                        <label for="password_siswa" class="form-label">Password Siswa</label>
                        <input required type="password" class="form-control" id="password_siswa" name="password_siswa"
                            placeholder="Masukkan password siswa">
                    </div>
                    <div class="form-group">
                        <label for="password_orangtua" class="form-label">Password Ortu</label>
                        <input required type="password" class="form-control" id="password_orangtua" name="password_orangtua"
                            placeholder="Masukkan password ortu siswa">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    $('#filter-btn').click(() => {
        $('#filter-section').toggleClass('d-none');
    })

    $('body').keypress(function (e) {
        if (e.keyCode == 13) {
            $('#filter-section').submit();
        }
    });

</script>
@endpush
