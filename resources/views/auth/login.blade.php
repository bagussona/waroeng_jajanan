@extends('layouts.auth')

@section('title')
    <title>Login</title>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-group">
                <div class="card p-4">
                    <div class="card-body">
                        <h1>Login</h1>

                        <!-- ACTIONNYA MENGARAH PADA URL /LOGIN -->
                        <!-- UNTUK MENCARI TAU TUJUAN URI DARI ROUTE NAME DIBAWAH, PADA COMMAND LINE, KETIKKAN PHP ARTISAN ROUTE:LIST DAN CARI URI YANG MENGGUNAKAN METHOD POST -->
                      	<!-- KARENA URI /LOGIN DENGAN METHOD GET DIGUNAKAN UNTUK ME-LOAD VIEW HALAMAN LOGIN -->
                      	<!-- PENGGUNAAN ROUTE() APABILA ROUTING TERSEBUT MEMILIKI NAMA, ADAPUN NAMENYA ADA PADA COLOM NAME ROUTE:LIST -->
                      	<!-- JIKA ROUTINGNYA TIDAK MEMILIKI NAMA, MAKA GUNAKAN HELPER URL() DAN DIDALAMNYA ADALAH URINYA. CONTOH URL('/LOGIN') -->
                          <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="icon-user"></i>
                                    </span>
                                </div>

                              	<!-- $errors->has('email') AKAN MENGECEK JIKA ADA ERROR DARI HASIL VALIDASI LARAVEL, SEMUA KEGAGALAN VALIDASI LARAVEL AKAN DISIMPAN KEDALAM VARIABLE $errors -->
                                <input class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}"
                                type="text"
                                name="username"
                                placeholder="Username"
                                value="{{ old('username') }}"
                                autofocus
                                required>
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="icon-lock"></i>
                                    </span>
                                </div>
                                <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" type="password" name="password" placeholder="Password" required>
                            </div>
                            <div class="row">
                                @if (session('error'))
                                <div class="col-md-12">
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                </div>
                                @endif

                                <div class="col-6">
                                    <input type="submit" class="btn btn-primary px-4" value="Login">
                                    {{-- <button>Login</button> --}}
                                </div>
                                <div class="col-6 text-right">
                                    {{-- <button class="btn btn-link px-0" type="button">Forgot password?</button> --}}
                                    <a class="hot_deal_link" href="{{ route('front.listLoved') }}"><button class="btn btn-link px-0" type="button">Forgot password?</button></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 mb-4">
                                </div>
                                <div class="col-8 mb-4">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                </div>
                                <div class="col-6">
                                    <a class="hot_deal_link" href="{{ route('register') }}"><button class="btn btn-link px-0" type="button">Belum Punya Akun?</button></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
                    <div class="card-body text-center">
                        {{-- <p>hello world</p> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
