@extends('layouts.main')

@section('header')
<div class="d-flex justify-content-between align-items-center mx-3 mt-5">
    <h1 class="m-0">Laporan Absensi</h1>
    <h4 class="m-0">
        @if (\App\Models\Auth::user() && \App\Models\Auth::user()->wali_kelas)
        <b>Laporan Absensi Kelas {{\App\Models\Auth::user()->wali_kelas}}</b>
        @else
        <b>Laporan Absensi Semua Kelas</b>
        @endif
    </h4>
</div><!-- /.row -->
@endsection

@section('content')
<section class="container mx-auto mt-5">
    <div class="d-flex justify-content-between mb-3">
        <button id="filter-btn" type="button" class="btn btn-primary">Filters</button>
        <form action="{{route('index')}}" class="w-25" method="GET">
            @csrf
            <input type="text" class="form-control" value="{{$data['keyword']}}" name="keyword" placeholder="Search">
        </form>
    </div>
    <form action="{{route('index')}}" method="GET" id="filter-section" class="mb-3">
        @csrf
        <div class="row">
            <div class="col-4">
                <div class="mb-3">
                    <label for="nisn" class="form-label">NISN</label>
                    <input value="{{$data['nisn']}}" type="number" name="nisn" class="form-control" id="nisn"
                        placeholder="Masukkan NISN disini">
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="date_from" class="form-label">Date From</label>
                    <input value="{{$data['date_from']}}" type="date" name="date_from" class="form-control"
                        id="date_from">
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="date_to" class="form-label">Date To</label>
                    <input value="{{$data['date_to']}}" type="date" name="date_to" class="form-control" id="date_to">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input value="{{$data['nama']}}" type="text" name="nama" class="form-control" id="nama"
                        placeholder="Masukkan nama disini">
                </div>
            </div>
            @if (\App\Models\Auth::user() && !\App\Models\Auth::user()->wali_kelas)
            <div class="col-4">
                <div class="mb-3">
                    <label for="kelas" class="form-label">Kelas</label>
                    <input value="{{$data['kelas']}}" type="text" name="kelas" class="form-control" id="kelas"
                        placeholder="Masukkan kelas disini">
                </div>
            </div>
            @endif
            <div class="col-4">
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <select class="form-control" name="keterangan">
                        <option selected value="">Masukkan keterangan disini</option>
                        <option @if ($data['keterangan']=='Masuk kelas' ) selected @endif value="Masuk kelas">Masuk
                            kelas</option>
                        <option @if ($data['keterangan']=='Alpha' ) selected @endif value="Alpha">Alpha</option>
                        <option @if ($data['keterangan']=='Ijin Sakit' ) selected @endif value="Ijin Sakit">Ijin Sakit
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </form>
    <table class="table" style="overflow-x: auto">
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
                <th scope="col" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data['absensi'] as $item)
            <tr>
                <th scope="row" class="text-center">{{$loop->iteration}}</th>
                <td class="text-center"><img width="100" height="150" src="{{asset($item->foto_masuk)}}" alt="Foto Masuk"></td>
                <td class="text-center"><small>{{date('d M Y', strtotime($item->tanggal_masuk))}}</small></td>
                <td class="text-center"><img width="100" height="150" src="{{asset($item->foto_pulang)}}" alt="Foto Pulang"></td>
                <td class="text-center"><small>{{date('d M Y', strtotime($item->tanggal_pulang))}}</small></td>
                <td class="text-center"><small>{{$item->siswa->nisn}}</small></td>
                <td class="text-center"><small>{{$item->siswa->kelas}}</small></td>
                <td class="text-center"><small>{{$item->siswa->nama_siswa}}</small></td>
                <td class="text-center"><small>{{$item->keterangan}}</small></td>
                <td class="text-center">
                    <form action="{{route('update', $item->id_absensi)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <select onchange="this.form.submit()" name="keterangan"
                            class="form-control w-75 text-center mx-auto">
                            <option selected disabled>Edit</option>
                            <option value="Masuk kelas">Masuk kelas</option>
                            <option value="Alpha">Alpha</option>
                            <option value="Ijin Sakit">Ijin Sakit</option>
                        </select>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <th scope="row" colspan="10" class="text-center">Absensi tidak ditemukan</th>
            </tr>
            @endforelse

        </tbody>
    </table>
</section>
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
