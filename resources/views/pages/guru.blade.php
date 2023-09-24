@extends('layouts.main')

@section('header')
<div class="d-flex justify-content-between align-items-center mx-3 mt-5">
    <h1 class="m-0">Data Guru</h1>
</div><!-- /.row -->
@endsection


@section('content')
<section class="container mx-auto mt-5">
    <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#createModal">
        Tambah Guru
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
                <th scope="col" class="text-center">Kode</th>
                <th scope="col" class="text-center">Nama</th>
                <th scope="col" class="text-center">Wali Kelas</th>
                <th scope="col" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data['guru'] as $item)
            <tr>
                <th scope="row" class="text-center">{{$loop->iteration}}</th>
                <td class="text-center"><small>{{$item->kode_guru}}</small></td>
                <td class="text-center"><small>{{$item->nama_guru}}</small></td>
                <td class="text-center">
                    @if ($item->wali_kelas)
                    <small>{{$item->wali_kelas}}</small>
                    @elseif($item->wali_kelas != 'admin') 
                    <small>Guru</small>
                    @elseif($item->wali_kelas == 'admin') 
                    <small>Admin</small>
                    @else
                    <small>Guru</small>
                    @endif
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-warning mb-2" data-toggle="modal" data-target="#editModal{{$item->id_guru}}">
                        <i class="fa fa-edit text-light"></i>
                    </button>
                    <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#deleteModal{{$item->id_guru}}">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>

            <!-- Modal -->
            <div class="modal fade" id="editModal{{$item->id_guru}}" tabindex="-1" aria-labelledby="editModal{{$item->id_guru}}Label"
                aria-hidden="true">
                <form action="{{route('guru.update')}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id_guru" value="{{$item->id_guru}}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModal{{$item->id_guru}}Label">Tambah Guru</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="kode_guru" class="form-label">Kode Guru</label>
                                    <input required type="number" class="form-control" id="kode_guru" name="kode_guru"
                                        placeholder="Masukkan kode guru" value="{{$item->kode_guru}}">
                                </div>
                                <div class="form-group">
                                    <label for="nama_guru" class="form-label">Nama</label>
                                    <input required type="text" class="form-control" id="nama_guru" name="nama_guru"
                                        placeholder="Masukkan nama guru" value="{{$item->nama_guru}}">
                                </div>
                                <div class="form-group">
                                    <label for="wali_kelas" class="form-label">Wali Kelas</label>
                                    <input type="text" class="form-control" id="wali_kelas" name="wali_kelas"
                                        placeholder="Masukkan kelas guru" value="{{$item->wali_kelas}}">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password"
                                        name="password" placeholder="Masukkan password guru">
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
            <div class="modal fade" id="deleteModal{{$item->id_guru}}" tabindex="-1" aria-labelledby="deleteModal{{$item->id_guru}}Label"
                aria-hidden="true">
                <form action="{{route('guru.delete')}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id_guru" value="{{$item->id_guru}}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModal{{$item->id_guru}}Label">Hapus Guru</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Guru <strong>{{$item->nama_guru}}</strong> akan dihapus</p>
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
    <form action="{{route('guru.store')}}" method="POST">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Guru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kode_guru" class="form-label">Kode Guru</label>
                        <input required type="number" class="form-control" id="kode_guru" name="kode_guru"
                            placeholder="Masukkan kode guru">
                    </div>
                    <div class="form-group">
                        <label for="nama_guru" class="form-label">Nama</label>
                        <input required type="text" class="form-control" id="nama_guru" name="nama_guru"
                            placeholder="Masukkan nama guru">
                    </div>
                    <div class="form-group">
                        <label for="wali_kelas" class="form-label">Wali Kelas</label>
                        <input type="text" class="form-control" id="wali_kelas" name="wali_kelas"
                            placeholder="Masukkan kelas guru">
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input required type="password" class="form-control" id="password"
                            name="password" placeholder="Masukkan password guru">
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
