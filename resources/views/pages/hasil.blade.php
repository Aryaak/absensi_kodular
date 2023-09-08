@extends('layouts.auth')

@section('content')
<section class="container">
    <div class="d-flex justify-content-end align-items-center">
        <img src="{{asset('img/logo.png')}}" width="100" alt="Logo">
    </div>

    <div class="mt-5 pt-5">
        <h3><b>Laporan Absensi</b></h3>
        <div class="d-flex justify-content-between align-items-start mb-5">
            <p><b>Laporan Absensi Kelas 12-A</b></p>
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
                    <th scope="col" class="text-center">Tanggal</th>
                    <th scope="col" class="text-center">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data['absensi'] as $item)
                <tr>
                    <th scope="row" class="text-center">{{$loop->iteration}}</th>
                    <td class="text-center"><img width="100" height="150" src="{{asset($item->foto_masuk)}}" alt="Foto Masuk"></td>
                    <td class="text-center">{{$item->tanggal_masuk}}</td>
                    <td class="text-center"><img width="100" height="150" src="{{asset($item->foto_pulang)}}" alt="Foto Pulang"></td>
                    <td class="text-center">{{$item->tanggal_pulang}}</td>
                    <td class="text-center">{{$item->siswa->nisn}}</td>
                    <td class="text-center">{{$item->siswa->kelas}}</td>
                    <td class="text-center">{{$item->siswa->nama_siswa}}</td>
                    <td class="text-center">{{date('d M Y', strtotime($item->tanggal))}}</td>
                    <td class="text-center">{{$item->keterangan}}</td>
                </tr>
                @empty
                <tr>
                    <th scope="row" colspan="7" class="text-center">Absensi tidak ditemukan</th>
                </tr>
                @endforelse
    
            </tbody>
        </table>
    </div>
</section>
@endsection
