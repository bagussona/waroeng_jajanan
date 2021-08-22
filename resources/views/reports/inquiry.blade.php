@extends('layouts.admin')

@section('title')
    <title>Inquiry</title>
@endsection

@section('content')

<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Reports</li>
        <li class="breadcrumb-item active">Inquiry</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Inquiry</h4>
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

                            <div class="container-wrapper">
                                <div class="header-date d-flex flex-row" style="padding: 15px;">
                                    <label for="inquiry_type" style="margin-left: 15px; margin-right: 15px;">Inquiry</label>
                                    <select name="inquiry_type" required width="276">
                                        <option value="">Pilih</option>
                                        <option value="PENJUALAN">Penjualan</option>
                                        <option value="PEMBELIAN">Pembelian</option>
                                    </select>
                                    <label for="datepickerform" style="margin-left: 15px; margin-right: 15px;">From: </label><input id="datepickerfrom" name="datepickerfrom" width="276" />
                                    <script>
                                        $('#datepickerfrom').datepicker({
                                            uiLibrary: 'bootstrap4'
                                        });
                                    </script>
                                    <label for="datepickerto" style="margin-left: 15px; margin-right: 15px;">To: </label><input id="datepickerto" name="datepickerto" width="276" />
                                    <script>
                                        $('#datepickerto').datepicker({
                                            uiLibrary: 'bootstrap4'
                                        });
                                    </script>
                                </div>
                            </div>

                            <!-- TABLE UNTUK MENAMPILKAN DATA PRODUK -->
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Produk</th>
                                            <th>Harga</th>
                                            <th>Harga Supplier</th>
                                            <th>Supplier</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Stock</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- LOOPING DATA TERSEBUT MENGGUNAKAN FORELSE -->
                                        <!-- ADAPUN PENJELASAN ADA PADA ARTIKEL SEBELUMNYA -->
                                        {{-- @forelse ($product as $row) --}}
                                        <tr>
                                            <td>
                                                Column 1
                                                <!-- TAMPILKAN GAMBAR DARI FOLDER PUBLIC/STORAGE/PRODUCTS -->
                                                <img src="#" width="100px" height="100px" alt="#">
                                            </td>
                                            <td>
                                                <strong> Column 2</strong><br>
                                                <!-- ADAPUN NAMA KATEGORINYA DIAMBIL DARI HASIL RELASI PRODUK DAN KATEGORI -->
                                                <label>kategori: <span class="badge badge-info">badge</span></label><br>
                                            </td>
                                            <td>Column 3</td>
                                            <td>Column 4</td>
                                            <td>Column 5</td>
                                            <td>Column 6</td>
                                            <td>Column 7</td>

                                            <!-- KARENA BERISI HTML MAKA KITA GUNAKAN { !! UNTUK MENCETAK DATA -->
                                            <td>Column 8</td>
                                            <td>
                                                Column 9
                                                <!-- FORM UNTUK MENGHAPUS DATA PRODUK -->
                                                {{-- <form action="{{ route('products.destroy', $row->id) }}" method="post"> --}}
                                                    {{-- @csrf --}}
                                                    {{-- @method('DELETE') --}}
                                                    {{-- <a href="{{ route('products.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a> --}}
                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                                {{-- <form action="{{ route('products.edit', $row->id) }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-cart-plus fa-lg"></i></button>
                                                </form>
                                            </td> --}}
                                        </tr>
                                        {{-- @empty --}}
                                        <tr>
                                            <td colspan="9" class="text-center">Tidak ada data</td>
                                        </tr>
                                        {{-- @endforelse --}}
                                    </tbody>
                                </table>
                            </div>
                            <!-- MEMBUAT LINK PAGINASI JIKA ADA -->
                            {{-- {!! $product->links() !!} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
