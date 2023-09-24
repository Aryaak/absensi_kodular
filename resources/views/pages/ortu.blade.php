@extends('layouts.auth')

@section('content')
<section class="container">
    <div class="d-flex justify-content-end align-items-center">
        {{-- <img src="{{asset('img/logo.png')}}" width="100" alt="Logo"> --}}
        <p class="text-danger">Butuh bantuan?</p>
    </div>

    <div class="d-flex justify-content-center mt-5 pt-5 mb-5">
        <img src="{{asset('img/logo.png')}}" width="150" alt="Logo">
    </div>


    <form action="{{route('ortu.hasil')}}" method="GET">
        @if (session('failed'))
        <p class="text-danger text-center  mx-auto ">{{session('failed')}}</p>
        @endif
        <input required style="border-radius: 100px !important;" type="email" name="email_ortu"
            placeholder="Masukkan email ortu" class="form-control w-50 mx-auto rounded mt-3 py-2">
        <input required style="border-radius: 100px !important;" type="password" name="password_orangtua"
            placeholder="Masukkan password email ortu" class="form-control w-50 mx-auto rounded mt-3 py-2">
        <button type="submit" style="opacity: 0">Cek Absensi Siswa</button>
    </form>
</section>
@endsection
