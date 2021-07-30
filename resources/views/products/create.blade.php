@extends('layouts.admin')

@section('title')
    <title>Tambah Produk</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Product</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">

          	<!-- TAMBAHKAN ENCTYPE="" KETIKA MENGIRIMKAN FILE PADA FORM -->
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data" >
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tambah Produk</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nama Produk</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                                    {{-- <p class="text-danger">{{ $errors->first('name') }}</p> --}}
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="description">Deskripsi</label>

                                    <!-- TAMBAHKAN ID YANG NNTINYA DIGUNAKAN UTK MENGHUBUNGKAN DENGAN CKEDITOR -->
                                    <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                                    <p class="text-danger">{{ $errors->first('description') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="status">Supplier</label>
                                    <select name="status" class="form-control" required>
                                        <option value="Wandi Grosir">[supplier->name]</option>
                                        {{-- <option value="0" {{ old('status') == '0' ? 'selected':'' }}>Draft</option> --}}
                                    </select>
                                    <p class="text-danger">{{ $errors->first('status') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Kategori</label>

                                    <!-- DATA KATEGORI DIGUNAKAN DISINI, SEHINGGA SETIAP PRODUK USER BISA MEMILIH KATEGORINYA -->
                                    <select name="category_id" class="form-control">
                                        <option value="">Pilih</option>
                                        {{-- @foreach ($category as $row) --}}
                                        {{-- <option value="{{ $row->id }}" {{ old('category_id') == $row->id ? 'selected':'' }}>{{ $row->name }}</option> --}}
                                        <option value="1">[kategori->name]</option>
                                        {{-- @endforeach --}}
                                    </select>
                                    <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="price">Harga Pcs</label>
                                    {{-- <input type="number" name="price" class="form-control" value="{{ old('price') }}" required> --}}
                                    <input type="number" name="price" class="form-control" value="price" required>
                                    <p class="text-danger">{{ $errors->first('price') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="price">Harga Pcs Supplier</label>
                                    {{-- <input type="number" name="price" class="form-control" value="{{ old('price') }}" required> --}}
                                    <input type="number" name="price_supplier" class="form-control" value="price_supplier" required>
                                    <p class="text-danger">{{ $errors->first('price_supplier') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="weight">Stock</label>
                                    {{-- <input type="number" name="weight" class="form-control" value="{{ old('weight') }}" required> --}}
                                    <input type="number" name="weight" class="form-control" value="weight" required>
                                    <p class="text-danger">{{ $errors->first('weight') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="image">Foto Produk</label>
                                    {{-- <input type="file" name="image" class="form-control" value="{{ old('image') }}" required> --}}
                                    <input type="file" name="image" class="form-control" value="image" required>
                                    <p class="text-danger">{{ $errors->first('image') }}</p>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection

<!-- PADA ADMIN LAYOUTS, TERDAPAT YIELD JS YANG BERARTI KITA BISA MEMBUAT SECTION JS UNTUK MENAMBAHKAN SCRIPT JS JIKA DIPERLUKAN -->
@section('js')
    <!-- LOAD CKEDITOR -->
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script>
        //TERAPKAN CKEDITOR PADA TEXTAREA DENGAN ID DESCRIPTION
        CKEDITOR.replace('description');
    </script>
@endsection
