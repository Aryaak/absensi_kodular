@extends('layouts.auth')

@section('content')
    <section class="container">
        <div class="d-flex justify-content-end align-items-center">
            {{-- <img src="{{asset('img/logo.png')}}" width="100" alt="Logo"> --}}
            <p class="text-danger">Butuh bantuan?</p>
        </div>

        <div class="d-flex justify-content-center mt-5 pt-5 mb-5">
            <img src="{{asset('img/logo.png')}}" width="150"  alt="Logo">
        </div>

        <form action="{{route('ortu.hasil')}}" method="GET">
            <input required autofocus style="border-radius: 100px !important;" type="number" name="nisn" placeholder="Cek berdasarkan NISN siswa" class="form-control w-50 mx-auto rounded mt-3 py-2">
        </form>
    </section>
@endsection