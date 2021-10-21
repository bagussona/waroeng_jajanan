@extends('layouts.auth')

@section('title')
    <title>Login {{ env('APP_NAME') }}</title>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-group">
                <div class="card p-4">
                    <div class="card-body">
                        <h1>Sign In</h1>
                        <p class="text-muted">Signing In your account</p>
                          <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="icon-user"></i>
                                    </span>
                                </div>
                                <input class="form-control @error('username') is-invalid @enderror"" type="text" name="username" placeholder="username" value="{{ old('username') }}" autofocus required>
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="icon-lock"></i>
                                    </span>
                                </div>
                                <input class="form-control @error('password') is-invalid @enderror"" type="password" name="password" placeholder="Password" required>
                            </div>
                            <div class="row">
                                    @error('username')
                                        <span class="alert alert-warning" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                    @error('password')
                                    <span class="alert alert-warning" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror

                                <div class="col-6">
                                    <input type="submit" class="btn btn-primary px-4" value="Login">
                                </div>
                                <div class="col-6 text-right">
                                    <a class="hot_deal_link" href="{{ route('password.update') }}"><button class="btn btn-link px-0" type="button">Forgot password?</button></a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
