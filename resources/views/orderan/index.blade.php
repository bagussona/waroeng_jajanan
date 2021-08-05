<!-- MEMANGGIL MASTER TEMPLATE YANG SUDAH DIBUAT SEBELUMNYA, YAKNI admin.blade.php -->
@extends('layouts.admin')

@section('title')
    <title>Kategori - {{ env('APP_NAME') }}</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Orderan</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">

                <!-- BAGIAN INI AKAN MENG-HANDLE TABLE LIST SUPPLIER  -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">List Orderan</h4>
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
                                        <tr>
                                            <th>Invoice</th>
                                            <th>Customer_id</th>
                                            <th>Customer_name</th>
                                            <th>Customer_phone</th>
                                            <th>Subtotal</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      	<!-- LOOPING DATA KATEGORI SESUAI JUMLAH DATA YANG ADA DI VARIABLE $SUPPLIER -->
                                        @forelse ($order_history as $val)
                                        <tr>
                                            {{-- <td>new arrival</td> --}}
                                            <td><strong>{{ $val->invoice }}</strong></td>

                                          	<!-- MENGGUNAKAN TERNARY OPERATOR, UNTUK MENGECEK, JIKA $val->parent ADA MAKA TAMPILKAN NAMA PARENTNYA, SELAIN ITU MAKA TANMPILKAN STRING - -->

                                            <!-- FORMAT TANGGAL KETIKA KATEGORI DIINPUT SESUAI FORMAT INDONESIA -->
                                            <td>{{ $val->customer_id }}</td>
                                            <td>{{ $val->customer_name }}</td>
                                            <td>{{ $val->customer_phone }}</td>
                                            <td>{{ $val->subtotal }}</td>
                                            <td>{{ $val->status }}</td>
                                            <td>
                                                <!-- FORM ACTION UNTUK METHOD VIEW -->
                                                <form action="{{ route('orderan.view') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="invoice" value="{{ $val->invoice }}">
                                                    <button type="submit" class="btn btn-info btn-sm">View</button>
                                                </form>
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

                        </div>
                    </div>
                </div>
                <!-- BAGIAN INI AKAN MENG-HANDLE TABLE LIST SUPPLIER  -->

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Orderan Masuk</h4>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Invoice</th>
                                            <th>Customer Name</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- LOOPING DATA KATEGORI SESUAI JUMLAH DATA YANG ADA DI VARIABLE $SUPPLIER -->
                                      @forelse ($order_detail as $val)
                                      <tr>
                                          <td>{{ $val->invoice }}</td>
                                          <td>{{ $val->customer_name }}</td>
                                          <td>{{ $val->status }}</td>
                                          <td>
                                            <!-- FORM ACTION UNTUK METHOD VIEW -->
                                            <form action="{{ route('orderan.view') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="invoice" value="{{ $val->invoice }}">
                                                <button type="submit" class="btn btn-info btn-sm">View</button>
                                            </form>
                                        </td>
                                      </tr>
                                      <tr>
                                        @empty
                                        <td colspan="4" class="text-center">Belum ada yg jajan hari ini..</td>
                                    </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
