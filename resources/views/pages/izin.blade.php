@extends('layouts.main')

@section('header')
<div class="d-flex justify-content-between align-items-center mx-3 mt-5">
    <h1 class="m-0">Izin Siswa</h1>
</div><!-- /.row -->
@endsection


@section('content')
<section class="container mx-auto mt-5">
    @if (session('success'))
    <div class="bg bg-success w-100 p-3">
        {{session('success')}}
    </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Tanggal Izin</th>
                <th>Foto</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data['izin'] as $item)
                <tr>
                    <td>{{explode(" ", $item->tanggal)[0]}}</td>
                    <td><img width="200" src="{{asset($item->foto)}}" alt="Foto Izin"></td>
                    <td>{{$item->status == 1 ? 'Disetujui' : 'Belum Disetujui'}}</td>
                    <td>{{$item->keterangan}}</td>
                    <td>
                        <form action="{{route('izin.acc')}}" method="GET">
                            <input type="hidden" name="id_izin" value="{{ $item->id_izin}}">
                        <button class="btn btn-primary">Setujui</button>
                    </form>
                    </td>
                </tr>
            @endforeach
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
