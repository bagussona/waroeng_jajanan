<!-- MEMANGGIL MASTER TEMPLATE YANG SUDAH DIBUAT SEBELUMNYA, YAKNI admin.blade.php -->
@extends('layouts.admin')

@section('title')
    <title>Member - {{ env('APP_NAME') }}</title>

    <style>
        .form__group {
            position: relative;
            padding: 15px 0 0;
            margin-top: 10px;
            width: 100%;
        }

        .form__field {
            font-family: inherit;
            width: 100%;
            border: 0;
            border-bottom: 2px solid #9b9b9b;
            outline: 0;
            font-size: 1.3rem;
            color: #000000;
            padding: 7px 0;
            background: transparent;
            transition: border-color 0.2s;
        }
        .form__field::placeholder {
            color: transparent;
            }
            .form__field:placeholder-shown ~ .form__label {
            font-size: 1.3rem;
            cursor: text;
            top: 20px;
        }

        .form__label {
            position: absolute;
            top: 0;
            display: block;
            transition: 0.2s;
            font-size: 1rem;
            color: #9b9b9b;
        }

        .form__field:focus ~ .form__label {
            position: absolute;
            top: 0;
            display: block;
            transition: 0.2s;
            font-size: 1rem;
            color: #11998e;
            font-weight: 700;
        }

        /* reset input */
        .form__field:required, .form__field:invalid {
            box-shadow: none;
        }

    </style>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Pengguna Terdaftar</li>
        <li class="breadcrumb-item active">Semua Pengguna</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">

                <!-- BAGIAN INI AKAN MENG-HANDLE TABLE LIST SUPPLIER  -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" style="margin-bottom: 0;">Daftar Pengguna</h4>
                        </div>
                        <div class="card-body">
                          	<!-- KETIKA ADA SESSION SUCCESS  -->
                            @if (session('success'))
                              <!-- MAKA TAMPILKAN ALERT SUCCESS -->
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <!-- KETIKA ADA SESSION ERROR  -->
                            @if (session('error'))
                              <!-- MAKA TAMPILKAN ALERT DANGER -->
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>No HP</th>
                                            <th>Gender</th>
                                            <th>Role</th>
                                            <th style="width: 140px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      	<!-- LOOPING DATA KATEGORI SESUAI JUMLAH DATA YANG ADA DI VARIABLE $SUPPLIER -->
                                        @forelse ($users as $user)
                                        <tr>
                                            <td><strong>{{ $user->name }}</strong></td>

                                          	<!-- MENGGUNAKAN TERNARY OPERATOR, UNTUK MENGECEK, JIKA $val->parent ADA MAKA TAMPILKAN NAMA PARENTNYA, SELAIN ITU MAKA TANMPILKAN STRING - -->

                                            <!-- FORMAT TANGGAL KETIKA KATEGORI DIINPUT SESUAI FORMAT INDONESIA -->
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->nohape }}</td>
                                            <td>{{ $user->gender }}</td>
                                            <td>{{ $user->role_names[0] }}</td>
                                            <td>
                                                <button class="btn btn-info btn-sm">View</button>
                                                <button class="btn btn-danger btn-sm">Delete</button>
                                            </td>
                                        </tr>
                                        <!-- JIKA DATA SUPPLIER KOSONG, MAKA AKAN DIRENDER KOLOM DIBAWAH INI  -->
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{ $users->links() }}

                        </div>
                    </div>
                </div>
                <!-- BAGIAN INI AKAN MENG-HANDLE TABLE LIST SUPPLIER  -->

                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" style="text-align: center; margin-bottom: 0;">Tambah Staff</h4>
                        </div>
                        <div class="card-body">
                            <div class="form__group field">
                                <input type="input" class="form__field" placeholder="Input your name.." name="name" id='name' required />
                                <label for="name" class="form__label">Name..</label>
                            </div>
                            <div class="form__group field">
                                <input type="input" class="form__field" placeholder="Input your email.." name="email" id='email' required />
                                <label for="email" class="form__label">Email..</label>
                            </div>
                            <div class="form__group field">
                                <input type="password" class="form__field" placeholder="Input your password.." name="password" id='password' required />
                                <label for="password" class="form__label">Password..</label>
                            </div>
                            <div class="form__group field">
                                <input type="password" class="form__field" placeholder="Confirm your passowrd" name="password_confirmation" id='password_confirmation' required />
                                <label for="password_confirmation" class="form__label">Confirm Password..</label>
                            </div>
                            <div class="form__group" style="margin-left: 40%;">
                                <form action="{{ route('members.store') }}" method="post">
                                @csrf
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-user-plus"></i> Tambah</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
