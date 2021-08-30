<!-- MEMANGGIL MASTER TEMPLATE YANG SUDAH DIBUAT SEBELUMNYA, YAKNI admin.blade.php -->
@extends('layouts.admin')

@section('title')
    <title>Kategori - {{ env('APP_NAME') }}</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Surat Pemindahan Barang</li>
        <li class="breadcrumb-item active">BBK</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">

              	<!-- BAGIAN INI AKAN MENG-HANDLE FORM BBK  -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Bukti Barang Keluar</h4>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('datastore.store') }}" method="post">
                                @csrf
                                <label for="datastore_name">Nama Barang</label>
                                <select name="datastore_name" class="form-control" required>

                                    @foreach ($data as $row)
                                    <option value="{{ $row->name }}">{{ $row->name }} <span class="form-control"> : Stock {{ $row->stock}}</span></option>
                                    @endforeach

                                </select>

                                {{-- <div class="form-group">
                                    <label for="datastore_stock">Stock Warehouse</label>
                                    <input type="text" name="datastore_stock" class="form-control" placeholder="{{ $row->stock }}" disabled>
                                    <p class="text-danger">{{ $errors->first('datastore_stock') }}</p>
                                </div> --}}

                                <p class="text-danger">{{ $errors->first('datastore_name') }}</p>


                                <div class="form-group">
                                    <label for="datastore_stock">Stock Transfer</label>
                                    <input type="text" name="datastore_stock" class="form-control" required>
                                    <p class="text-danger">{{ $errors->first('datastore_stock') }}</p>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-sm">Add to Cart</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <!-- BAGIAN INI AKAN MENG-HANDLE FORM INPUT NEW SUPPLIER  -->

                @if (Auth::user()->role_names[0] == 'admin')
                <!-- BAGIAN INI AKAN MENG-HANDLE TABLE LIST SUPPLIER  -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">List BBK - {{ Auth::user()->name }}</h4>
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
                                            <th>Produk</th>
                                            <th>Harga</th>
                                            <th>Category</th>
                                            <th>Supplier</th>
                                            <th>Stock</th>
                                            <th>Author</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      	<!-- LOOPING DATA KATEGORI SESUAI JUMLAH DATA YANG ADA DI VARIABLE $SUPPLIER -->
                                        @forelse ($spb_admin as $val)
                                        <tr>
                                            {{-- <td>new arrival</td> --}}
                                            <td><strong>{{ $val->name }}</strong></td>

                                          	<!-- MENGGUNAKAN TERNARY OPERATOR, UNTUK MENGECEK, JIKA $val->parent ADA MAKA TAMPILKAN NAMA PARENTNYA, SELAIN ITU MAKA TANMPILKAN STRING - -->

                                            <!-- FORMAT TANGGAL KETIKA KATEGORI DIINPUT SESUAI FORMAT INDONESIA -->
                                            <td>{{ number_format($val->price) }}</td>
                                            <td>{{ $val->category }}</td>
                                            <td>{{ $val->supplier }}</td>
                                            <td>{{ $val->stock }}</td>
                                            <td>{{ $val->author }}</td>
                                            <td>{{ $val->keterangan }}</td>
                                            <td>

                                                <!-- FORM ACTION UNTUK METHOD DELETE -->
                                                <form action="{{ route('datastore.destroyBBK', $val->id) }}" method="POST">
                                                    <!-- KONVERSI DARI @ CSRF & @ METHOD AKAN DIJELASKAN DIBAWAH -->
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <!-- JIKA DATA SUPPLIER KOSONG, MAKA AKAN DIRENDER KOLOM DIBAWAH INI  -->
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Tidak ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <form action="{{ route('datastore.bbk') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary float-right"><i class="fas fa-archive"></i> BBK</button>
                            </form>
                            <button class="btn btn-danger"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>  PDF</button>
                            <button class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
                        </div>
                    </div>
                </div>
                @endif
                <!-- BAGIAN INI AKAN MENG-HANDLE TABLE LIST SUPPLIER  -->
                @if (Auth::user()->role_names[0] == 'staff')
                                <!-- BAGIAN INI AKAN MENG-HANDLE TABLE LIST SUPPLIER  -->
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Cart - List BBK</h4>
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
                                                            <th>Produk</th>
                                                            <th>Harga</th>
                                                            <th>Category</th>
                                                            <th>Supplier</th>
                                                            <th>Stock</th>
                                                            <th>Author</th>
                                                            <th>Keterangan</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                          <!-- LOOPING DATA KATEGORI SESUAI JUMLAH DATA YANG ADA DI VARIABLE $SUPPLIER -->
                                                        @forelse ($spb as $val)
                                                        <tr>
                                                            <td><strong>{{ $val->name }}</strong></td>

                                                              <!-- MENGGUNAKAN TERNARY OPERATOR, UNTUK MENGECEK, JIKA $val->parent ADA MAKA TAMPILKAN NAMA PARENTNYA, SELAIN ITU MAKA TANMPILKAN STRING - -->

                                                            <!-- FORMAT TANGGAL KETIKA KATEGORI DIINPUT SESUAI FORMAT INDONESIA -->
                                                            <td>{{ number_format($val->price) }}</td>
                                                            <td>{{ $val->category }}</td>
                                                            <td>{{ $val->supplier }}</td>
                                                            <td>{{ $val->stock }}</td>
                                                            <td>{{ $val->author }}</td>
                                                            <td>{{ $val->keterangan }}</td>
                                                            <td>

                                                                <!-- FORM ACTION UNTUK METHOD DELETE -->
                                                                <form action="{{ route('datastore.destroyBBK', $val->id) }}" method="POST">
                                                                    <!-- KONVERSI DARI @ CSRF & @ METHOD AKAN DIJELASKAN DIBAWAH -->
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                        <!-- JIKA DATA SUPPLIER KOSONG, MAKA AKAN DIRENDER KOLOM DIBAWAH INI  -->
                                                        @empty
                                                        <tr>
                                                            <td colspan="8" class="text-center">Tidak ada data</td>
                                                        </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                            <form action="{{ route('datastore.bbk') }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm float-right">BBK</button>
                                            </form>
                                            <button class="btn btn-danger"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>  PDF</button>
                                            <button class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- BAGIAN INI AKAN MENG-HANDLE TABLE LIST SUPPLIER  -->
                                @endif
            </div>
        </div>
    </div>
</main>

@endsection
