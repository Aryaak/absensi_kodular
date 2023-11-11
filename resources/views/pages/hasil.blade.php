@extends('layouts.auth')

@section('content')
<section class="container">
    <div class="d-flex justify-content-end align-items-center">
        <img src="{{asset('img/logo.png')}}" width="100" alt="Logo">
    </div>

    <div class="mt-5 pt-5">
        <h3><b>Laporan Absensi</b></h3>
        <div class="d-flex justify-content-between align-items-start mb-5">
            <p><b>Laporan Absensi Kelas {{$data['siswa']->kelas}}</b></p>
            <div>
                <p class="m-0">
                    <b>Atas Nama</b>
                    <span>{{$data['siswa']->nama_siswa}}</span>
                </p>
                <p class="m-0">
                    <b>NISN</b>
                    <span>{{$data['siswa']->nisn}}</span>
                </p>
            </div>
        </div>

        <div>
            <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#createModal">
                Izin Siswa
            </button>
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#riwayatModal">
                Riwayat Izin Siswa
            </button>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Nomor</th>
                    <th scope="col" class="text-center">Foto Masuk</th>
                    <th scope="col" class="text-center">Tanggal Masuk</th>
                    <th scope="col" class="text-center">Foto Pulang</th>
                    <th scope="col" class="text-center">Tanggal Pulang</th>
                    <th scope="col" class="text-center">NISN</th>
                    <th scope="col" class="text-center">Kelas</th>
                    <th scope="col" class="text-center">Nama Siswa</th>
                    <th scope="col" class="text-center">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data['absensi'] as $item)
                <tr>
                    <td scope="row" class="text-center">{{$loop->iteration}}</td>
                    <td class="text-center"><img width="100" height="150" src="{{asset($item->foto_masuk)}}"
                            alt="Foto Masuk"></td>
                    <td class="text-center"><small>{{date('d M Y H:i:s', strtotime($item->tanggal_masuk))}}</small></td>
                    <td class="text-center"><img width="100" height="150" src="{{asset($item->foto_pulang)}}"
                            alt="Foto Pulang"></td>
                    <td class="text-center">
                        <small>{{$item->tanggal_pulang ? date('d M Y H:i:s', strtotime($item->tanggal_pulang)) : '-'}}</small>
                    </td>
                    <td class="text-center">{{$item->siswa->nisn}}</td>
                    <td class="text-center">{{$item->siswa->kelas}}</td>
                    <td class="text-center">{{$item->siswa->nama_siswa}}</td>
                    <td class="text-center">{{$item->keterangan}}</td>
                </tr>
                @empty
                <tr>
                    <th scope="row" colspan="10" class="text-center">Absensi tidak ditemukan</th>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <form action="{{route('izin.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id_siswa" value="{{$data['siswa']->id_siswa}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Izin Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input required type="date" class="form-control" id="tanggal" name="tanggal"
                            placeholder="Masukkan tanggal izin siswa" value="">
                    </div>
                    <div class="form-group">
                        <label for="lama" class="form-label">Lama Izin</label>
                        <input required type="number" class="form-control" id="lama" name="lama"
                            placeholder="Masukkan lama izin siswa" value="">
                    </div>
                    <div class="form-group">
                        <label for="keterangan" class="form-label">Keterangan Izin</label>
                        <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="10"
                            placeholder="Masukkan keterangan izin siswa"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="foto" class="form-label">Bukti Izin</label>
                        <input required type="file" class="form-control" id="foto" name="foto"
                            placeholder="Masukkan bukti izin siswa" value="">
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
<div class="modal fade" id="riwayatModal" tabindex="-1" aria-labelledby="riwayatModalLabel" aria-hidden="true">
        @csrf
        <input type="hidden" name="id_siswa" value="{{$data['siswa']->id_siswa}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="riwayatModalLabel">Riwayat Izin Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tanggal Izin</th>
                                <th>Foto</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['izin'] as $item)
                                <tr>
                                    <td>{{explode(" ", $item->tanggal)[0]}}</td>
                                    <td><img width="200" src="{{asset($item->foto)}}" alt="Foto Izin"></td>
                                    <td>{{$item->keterangan}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
</div>
@endsection
