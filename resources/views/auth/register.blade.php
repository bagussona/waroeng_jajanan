@extends('layouts.auth')

@section('title')
    <title>Register {{ env('APP_NAME') }}</title>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-group">
                <div class="card p-4">
                    <div class="card-body">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    {{-- code.. --}}
                                </div>
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    {{-- code.. --}}
                                </div>
                                    {{-- code.. --}}
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    {{-- <div class="alert alert-danger" role="alert"> --}}
                                        {{-- code.. --}}
                                    {{-- </div> --}}
                                </div>

                                <div class="col-6">
                                    {{-- code.. --}}
                                </div>
                                <div class="row">
                                    <div class="col-7">
                                    </div>
                                    <div class="col-5">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%"> --}}
                <div class="card text-white bg-primary py-5 d-md-down-none">
                    <div class="card-body text-center">
                        <h1>Sign Up</h1>
                        <p class="text-muted">Signing Up your account</p>
                        <form action="{{ route('register') }}" method="POST">
                            @csrf

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-user"></i></span>
                                </div>
                                    <input class="form-control" type="text" name="name" placeholder="Insert full name.." value="{{ old('name') }}" autofocus required>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-envelope"></i></span>
                                </div>
                                <input class="form-control @error('email') is-invalid @enderror" type="email"  name="email" placeholder="Insert email.." value="{{ old('email') }}" required>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-lock"></i></span>
                                </div>
                                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Insert password.." required>
                            </div>


                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-lock"></i></span>
                                </div>
                                <input class="form-control" type="password" name="password_confirmation" placeholder="Password Confirmation" required>
                            </div>

                            <div class="row">
                                @error('email')
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
                                    <input class="btn btn-light px-4" type="submit" value="Register">
                                </div>

                                <div class="row">
                                    <div class="col-7">
                                    </div>
                                    <div class="col-5">
                                        <a class="hot_deal_link" href="{{ route('login') }}"><button class="btn btn-primary px-0" type="button">Login?</button></a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
