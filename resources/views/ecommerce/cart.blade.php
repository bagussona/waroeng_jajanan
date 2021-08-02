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
                <form action="{{ route('front.update_cart') }}" method="post">
                    @csrf
        <!-- DISABLE BAGIAN INI JIKA INGIN MELIHAT HASILNYA TERLEBIH DAHULU -->

				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr style="text-align: center">
								<th scope="col">Product</th>
								<th scope="col">Price</th>
								<th scope="col">Quantity</th>
								<th scope="col">Total</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
              <!-- LOOPING DATA DARI VARIABLE CARTS -->
                            @forelse ($carts as $row)
							<tr style="text-align: center">
								<td>
									<div class="media">
										<div class="d-flex">
                                            <img src="{{ $row['image'] }}" width="100px" height="100px" alt="{{ $row['name'] }}">
										</div>
										<div class="media-body">
                                            <p>{{ $row['name'] }}</p>
										</div>
									</div>
								</td>
								<td>
                                    <h5>Rp {{ number_format($row['price']) }}</h5>
								</td>
								<td>
									<div class="product_count">


                    <!-- PERHATIKAN BAGIAN INI, NAMENYA KITA GUNAKAN ARRAY AGAR BISA MENYIMPAN LEBIH DARI 1 DATA -->
                                        <input type="text" name="qty[]" id="sst{{ $row['product_id'] }}" maxlength="12" value="{{ $row['qty'] }}" title="Quantity:" class="input-text qty">
                                        <input type="hidden" name="product_id[]" value="{{ $row['product_id'] }}" class="form-control">
                    <!-- PERHATIKAN BAGIAN INI, NAMENYA KITA GUNAKAN ARRAY AGAR BISA MENYIMPAN LEBIH DARI 1 DATA -->


										<button onclick="var result = document.getElementById('sst{{ $row['product_id'] }}'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
										 class="increase items-count" type="button">
											<i class="fa fa-plus no-float btn-up-cart"></i>
										</button>
										<button onclick="var result = document.getElementById('sst{{ $row['product_id'] }}'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
										 class="reduced items-count" type="button">
											<i class="fa fa-minus no-float btn-down-cart"></i>
										</button>
									</div>
								</td>
								<td>
                                    <h5>Rp {{ number_format($row['subtotal']) }}</h5>
								</td>
                                <td>
                                    <button class="gray_btn">Update Cart</button>
                                    {{-- <button class="gray_btn">Clear Cart</button> --}}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">Tidak ada jajanan</td>
                            </tr>
                            @endforelse
                            </tr>
                            </form>
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
