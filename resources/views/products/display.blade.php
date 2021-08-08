@extends('layouts.admin')

@section('title')
    <title>List Product</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Product</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                Display Toko - List Product
                            </h4>
                        </div>
                        <div class="card-body">
                            <!-- JIKA TERDAPAT FLASH SESSION, MAKA TAMPILAKAN -->
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            <!-- JIKA TERDAPAT FLASH SESSION, MAKA TAMPILAKAN -->

                            <!-- BUAT FORM UNTUK PENCARIAN, METHODNYA ADALAH GET -->
                            <form action="{{ route('products.display') }}" method="get">
                                <div class="input-group mb-3 col-md-3 float-right">
                                    <!-- KEMUDIAN NAME-NYA ADALAH Q YANG AKAN MENAMPUNG DATA PENCARIAN -->
                                    {{-- <input type="text" name="q" class="form-control" placeholder="Cari..." value="{{ request()->q }}"> --}}
                                    <input type="text" name="q" class="form-control" placeholder="Cari..." value="">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="button">Cari</button>
                                    </div>
                                </div>
                            </form>

                            <!-- TABLE UNTUK MENAMPILKAN DATA PRODUK -->
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Produk</th>
                                            <th>Harga</th>
                                            <th>Supplier</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- LOOPING DATA TERSEBUT MENGGUNAKAN FORELSE -->
                                        <!-- ADAPUN PENJELASAN ADA PADA ARTIKEL SEBELUMNYA -->
                                        @forelse ($display as $row)
                                        <tr>
                                            <td>
                                                <img src="{{ $row->image }}" width="100px" height="100px" alt="{{ $row->name }}">
                                            </td>
                                            <td>
                                                <strong> {{ $row->name }} </strong><br>
                                                <!-- ADAPUN NAMA KATEGORINYA DIAMBIL DARI HASIL RELASI PRODUK DAN KATEGORI -->
                                                <label>kategori: <span class="badge badge-info">{{ $row->category }}</span></label><br>
                                                {{-- <label>description: <span class="badge badge-info">{!! $row->description !!}</span></label> --}}
                                            </td>
                                            <td>Rp. {{ number_format($row->price) }}</td>
                                            <td>{{ $row->supplier }}</td>
                                            <td>{{ $row->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $row->updated_at->format('d-m-Y') }}</td>

                                            <!-- KARENA BERISI HTML MAKA KITA GUNAKAN { !! UNTUK MENCETAK DATA -->
                                            {{-- <td>{!! $row->status_label !!}</td> --}}
                                            <td>{{ $row->stock }} Pcs</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="9" class="text-center">Tidak ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- MEMBUAT LINK PAGINASI JIKA ADA -->
                            {!! $display->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
