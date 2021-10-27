@extends('layouts.auth')

@section('title')
    <title>Register {{ env('APP_NAME') }}</title>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-group">
                <div class="card p-4 bg-primary">
                    <div class="card-body col-12">
                        <h1>Sign Up</h1>
                        <p>Signing Up your account</p>
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $errors->first() }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <form action="{{ route('register') }}" method="POST">
                            @csrf

                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-user"></i></span>
                                </div>
                                <input class="form-control" type="text" name="name" placeholder="Insert full name.."
                                    value="{{ old('name') }}" autofocus autocomplete="off" required
                                    oninvalid="this.setCustomValidity('Wajib diisi')" oninput="this.setCustomValidity('')">
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-at"></i></span>
                                </div>
                                <input class="form-control" type="text" name="username" placeholder="Insert username.."
                                    value="{{ old('username') }}" required
                                    oninvalid="this.setCustomValidity('Wajib diisi')" oninput="this.setCustomValidity('')">
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-envelope"></i></span>
                                </div>
                                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email"
                                    placeholder="Insert email.." value="{{ old('email') }}" required
                                    oninvalid="this.setCustomValidity('Wajib diisi')" oninput="this.setCustomValidity('')">
                            </div>

                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-lock"></i></span>
                                </div>
                                <input class="form-control @error('password') is-invalid @enderror" type="password"
                                    name="password" placeholder="Insert password.." required
                                    oninvalid="this.setCustomValidity('Wajib diisi')" oninput="this.setCustomValidity('')">
                            </div>


                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-lock"></i></span>
                                </div>
                                <input class="form-control" type="password" name="password_confirmation"
                                    placeholder="Password Confirmation" required
                                    oninvalid="this.setCustomValidity('Wajib diisi')" oninput="this.setCustomValidity('')">
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <input class="btn btn-light px-4" type="submit" value="Register">
                                </div>
                                <div class="col-6">
                                    <a class="hot_deal_link" href="{{ route('login') }}"><button
                                            class="btn btn-primary px-4" type="button">Sudah punya akun?</button></a>
                                </div>

                                {{--<div class="row">
                                </div>--}}
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card text-white d-md-down-none col-5" style="background-color: #fff">
                    <div class="card-body text-center">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
