@extends('layouts.ecommerce')

@section('title')
    <title>CART - {{ env('APP_NAME') }}</title>
@endsection

@section('content')
    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content text-center">
                    <h2>Keranjang Belanja</h2>
                    <div class="page_link">
                        <a href="{{ url('/') }}">Home</a>
                        <a href="{{ route('front.list_cart') }}">Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">

                <!-- DISABLE BAGIAN INI JIKA INGIN MELIHAT HASILNYA TERLEBIH DAHULU -->
                <!-- KARENA MODULENYA AKAN DIKERJAKAN PADA SUB BAB SELANJUTNYA -->
                <!-- HANYA SAJA DEMI KEMUDAHAN PENULISAN MAKA SAYA MASUKKAN PADA BAGIAN INI -->
                <!-- DISABLE BAGIAN INI JIKA INGIN MELIHAT HASILNYA TERLEBIH DAHULU -->

                <div class="table-responsive">
                    @if (session('success') || session('error'))
                        <div class="alert {{ session('success') ? 'alert-success' : 'alert-danger' }} alert-dismissible fade show"
                            role="alert">
                            {{ session('success') ?? session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr style="text-align: center">
                                <th scope="col">Image</th>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col" colspan="2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- LOOPING DATA DARI VARIABLE CARTS -->
                            @forelse ($carts as $cart)
                                <tr style="text-align: center">
                                    <td>
                                        <div class="media justify-content-center">
                                            <div class="d-flex justify-content-center">
                                                <img src="{{ $cart['image'] }}" width="100px" height="100px"
                                                    alt="{{ $cart['name'] }}" class="rounded mx-auto d-block">
                                            </div>
                                        </div>
                                    </td>
                                    <td style="text-align: center">
                                        <div class="media-body">
                                            <p>{{ $cart['name'] }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <h5>Rp {{ number_format($cart['price']) }}</h5>
                                    </td>
                                    <td>
                                        <div class="product_count justify-content-center">
                                            <form action="{{ route('front.update_cart') }}" method="post">
                                                @csrf

                                                <!-- PERHATIKAN BAGIAN INI, NAMENYA KITA GUNAKAN ARRAY AGAR BISA MENYIMPAN LEBIH DARI 1 DATA -->
                                                <input type="hidden" name="id" value="{{ $cart['id'] }}"
                                                    class="form-control">
                                                @foreach ($products as $product)
                                                    @if ($product['name'] == $cart['name'])
                                                        <input type="number" name="qty" id="sst{{ $cart['id'] }}"
                                                            maxlength="12" value="{{ $cart['qty'] }}" min="1"
                                                            max="{{ $product->stock }}" title="Quantity:"
                                                            class="input-text qty"
                                                            oninvalid="this.setCustomValidity('Jumlah yang dimasukkan melebihi stok')"
                                                            oninput="this.setCustomValidity('')" autocomplete="off">
                                                    @endif
                                                @endforeach
                                                    <!-- PERHATIKAN BAGIAN INI, NAMENYA KITA GUNAKAN ARRAY AGAR BISA MENYIMPAN LEBIH DARI 1 DATA -->

                                                    <button
                                                        onclick="var result = document.getElementById('sst{{ $cart['id'] }}'); var sst = result.value; if( !isNaN( sst )  && sst < {{ $product->stock }}) result.value++;return false;"
                                                        class="increase items-count" type="button">
                                                        <i class="fa fa-plus no-float btn-up-cart"></i>
                                                    </button>
                                                    <button
                                                        onclick="var result = document.getElementById('sst{{ $cart['id'] }}'); var sst = result.value; if( !isNaN( sst ) && sst > 1 ) result.value--;return false;"
                                                        class="reduced items-count" type="button">
                                                        <i class="fa fa-minus no-float btn-down-cart"></i>
                                                    </button>
                                        </div>
                                    </td>
                                    <td>
                                        <h5>Rp {{ number_format($cart['subtotal']) }}</h5>
                                    </td>
                                    <td>
                                        <button class="btn btn_primary"><i class="fa fa-pencil-square-o"></i></button>
                                    </td>
                                    </form>
                                    <form action=" {{ route('front.delete_cart') }} " method="post">
                                        <td>
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="order_id" value="{{ $cart['id'] }}"
                                                class="form-control">
                                            <button class="btn btn_danger" disabled><i class="fa fa-trash-o"></i></button>
                                        </td>
                                    </form>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">Tidak ada jajanan</td>
                                    </tr>
                                @endforelse
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <h5 style="text-align: right">Subtotal</h5>
                                    </td>
                                    <td>
                                        <h3 style="text-align: right">Rp {{ number_format($subtotal) }}.00,-</h3>
                                    </td>
                                </tr>
                                <tr class="out_button_area">
                                    <td colspan="4" style="text-align: right">
                                        <a class="gray_btn" href="{{ route('front.product') }}">Jajan Lagi?</a>
                                    </td>
                                    <td style="text-align: right">
                                        <a class="main_btn" href="{{ route('front.checkout') }}">Checkout</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Cart Area =================-->
    @endsection
