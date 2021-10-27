@extends('layouts.auth')

@section('title')
    <title>Login {{ env('APP_NAME') }}</title>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-group" style="height: 450px">
                <div class="card p-4">
                    <div class="card-body col-12">
                        <h1>Sign In</h1>
                        <p class="text-muted">Signing In your account</p>
                        @if ($errors->has('username'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Username atau Password salah
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="icon-user"></i>
                                    </span>
                                </div>
                                <input class="form-control @error('username') is-invalid @enderror" type="text"
                                    name="username" placeholder="username" value="{{ old('username') }}" autofocus
                                    required oninvalid="this.setCustomValidity('Wajib diisi')"
                                    oninput="this.setCustomValidity('')">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="icon-lock"></i>
                                    </span>
                                </div>
                                <input class="form-control" type="password" name="password" placeholder="Password"
                                    required oninvalid="this.setCustomValidity('Wajib diisi')"
                                    oninput="this.setCustomValidity('')">
                            </div>
                            <div class="row mb-4">
                                <div class="col-6 text-left">
                                    <a class="hot_deal_link" href="{{ route('password.update') }}"><button
                                            class="btn btn-link px-0" type="button">Forgot password?</button></a>
                                </div>
                                <div class="col-6 text-right">
                                    <input type="submit" class="btn btn-primary px-4" value="Login">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <a class="hot_deal_link" href="{{ route('register') }}"><button
                                            class="btn btn-link px-0" type="button">Belum Punya Akun?</button></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card text-white bg-primary d-md-down-none col-5">
                    <div class="card-body text-center">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
