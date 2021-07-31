@extends('layouts.admin')

@section('title')
    <title>Edit Produk</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Product</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">

          	<!-- PASTIKAN MENGIRIMKAN ID PADA ROUTE YANG DIGUNAKAN -->
            <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data" >
                @csrf
              	<!-- KARENA UPDATE MAKA KITA GUNAKAN DIRECTIVE DIBAWAH INI -->
                @method('PUT')

              	<!-- FORM INI SAMA DENGAN CREATE, YANG BERBEDA HANYA ADA TAMBAHKAN VALUE UNTUK MASING-MASING INPUTAN  -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Update Produk</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nama Produk</label>
                                    <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <textarea name="description" id="description" class="form-control">{{ $product->description }}</textarea>
                                    <p class="text-danger">{{ $errors->first('description') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">

                                    <label for="supplier">Supplier</label>
                                    <select name="supplier" class="form-control" required>
                                        <option value="wandi_grosir">Wandi Grosir</option>
                                        <option value="">Pilih Supplier</option>
                                        <option value="warjan">Waroeng Jajanan</option>
                                        {{-- <option value="0" {{ old('supplier') == '0' ? 'selected':'' }}>Draft</option> --}}
                                    </select>
                                    <p class="text-danger">{{ $errors->first('supplier') }}</p>

                                </div>
                                <div class="form-group">
                                    <label for="category_id">Kategori</label>
                                    <select name="category_id" class="form-control">
                                        <option value="">Pilih</option>
                                        @foreach ($category as $row)
                                        <option value="{{ $row->id }}" {{ $product->category_id == $row->id ? 'selected':'' }}>{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="price_supplier">Harga Pcs Supplier</label>
                                    <input type="number" name="price_supplier" class="form-control" value="{{ $product->price_supplier }}" required>
                                    {{-- <input type="number" name="price_supplier" class="form-control" placeholder="0 /Pcs" required> --}}
                                    {{-- <input type="number" name="price_supplier" class="form-control" placeholder="price_supplier" required> --}}
                                    <p class="text-danger">{{ $errors->first('price_supplier') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
                                    {{-- <input type="number" name="weight" class="form-control" value="{{ old('weight') }}" required> --}}
                                    {{-- <input type="number" name="stock" class="form-control" placeholder="insert stock" required> --}}
                                    <p class="text-danger">{{ $errors->first('stock') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="price">Harga Pcs Display</label>
                                    <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
                                    {{-- <input type="number" name="price" class="form-control" placeholder="0 /Pcs" required> --}}
                                    {{-- <input type="number" name="price" class="form-control" value="price" required> --}}
                                    <p class="text-danger">{{ $errors->first('price') }}</p>
                                </div>

                              	<!-- GAMBAR TIDAK LAGI WAJIB, JIKA DIISI MAKA GAMBAR AKAN DIGANTI, JIKA DIBIARKAN KOSONG MAKA GAMBAR TIDAK AKAN DIUPDATE -->
                                <div class="form-group">
                                    <label for="image">Foto Produk</label>
                                    <br>
                                  	<!--  TAMPILKAN GAMBAR SAAT INI -->
                                    <img src="{{ $product->image }}" width="100px" height="100px" alt="{{ $product->name }}">
                                    <hr>
                                    <input type="file" name="image" class="form-control">
                                    <p><strong>Biarkan kosong jika tidak ingin mengganti gambar</strong></p>
                                    <p class="text-danger">{{ $errors->first('image') }}</p>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">Update</button>
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

@section('js')
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
@endsection

