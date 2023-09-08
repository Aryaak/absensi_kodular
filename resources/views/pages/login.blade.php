@extends('layouts.auth')

@section('content')
<section class="container">
    <div class="d-flex justify-content-between align-items-center">
        <img src="{{asset('img/logo.png')}}" width="100" alt="Logo">
        <p class="text-danger">Butuh bantuan?</p>
    </div>

    <div class="d-flex justify-content-between my-5">
        <img class="w-50 mr-5 rounded" width="400" src="{{asset('img/banner.jpg')}}" alt="Banneer">
        <div>
            <div class="text-center mb-5">
                <h3>Login</h3>
                <p>Silahkan login untuk melanjutkan</p>
            </div>

            <form style="width: 400px;" class="mt-3" action="{{route('login.check')}}" method="POST">
                @csrf
                @if (session('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
                @endif
                <div class="form-group mb-3">
                    <label for="kode_guru" class="form-label w-75">Masukkan ID</label>
                    <input type="text" name="kode_guru" placeholder="Masukkan ID disini" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" placeholder="Masukkan password disini" class="form-control">
                </div>

                <p class="text-danger mb-5 text-right">Lupa password?</p>

                <button type="submit" class="btn btn-primary mt-5 w-100">Login</button>
            </form>
        </div>
    </div>
</section>
@endsection
