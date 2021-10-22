@extends('layouts.ecommerce')

@section('title')
<title>CHECKOUT - {{ env('APP_NAME') }}</title>
@endsection

@section('content')
    <!--================Home Banner Area =================-->
	<section class="banner_area">
		<div class="banner_inner d-flex align-items-center">
			<div class="overlay"></div>
			<div class="container">
				<div class="banner_content text-center">
					<h2>Informasi Pembayaran</h2>
					<div class="page_link">
            <a href="{{ url('/') }}">Home</a>
						<a href="#">Checkout</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Home Banner Area =================-->

	<!--================Checkout Area =================-->
	<section class="checkout_area section_gap">
		<div class="container">
			<div class="billing_details">
				<div class="row">
					<div class="col-lg-8">
            <h3>Informasi Pembayaran</h3>
              @if (session('error'))
                  <div class="alert alert-danger">{{ session('error') }}</div>
              @endif
              <form class="row contact_form" action="{{ route('front.store_checkout') }}" method="post" novalidate="novalidate">
                            @csrf
                        <div class="col-md-12 form-group p_star">
                            <label for="name">Nama Lengkap</label>
                            <input style="background-color: #ffffff; border: 0;"type="text" class="form-control" id="first" name="name" value="{{ $user->name }}" required>
                            <p class="text-danger">{{ $errors->first('name') }}</p>
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <label for="nohape">No Telp</label>
                            <input style="background-color: #ffffff; border: 0;"type="text" class="form-control" id="number" name="nohape" value="{{ $user->nohape }}" required readonly>
                            <p class="text-danger">{{ $errors->first('nohape') }}</p>
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <label for="email">Email</label>
                            <input style="background-color: #ffffff; border: 0;"type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required readonly>
                            <p class="text-danger">{{ $errors->first('email') }}</p>
                        </div>

					</div>
					<div class="col-lg-4">
						<div class="order_box">
							<h2>Ringkasan Pesanan</h2>
							<ul class="list">
								<li>
									<a href="#">Product
										<span>Total</span>
									</a>
                </li>
                @foreach ($carts as $cart)
								<li>
									<a href="#">{{ \Str::limit($cart['name'], 10) }}
                    <span class="middle">x {{ $cart['qty'] }}</span>
                    <span class="last">Rp {{ number_format($cart['price']) }}</span>
									</a>
                </li>
                @endforeach
							</ul>
							<ul class="list list_2">
								<li>
									<a href="#">Subtotal
                    <span>Rp {{ number_format($subtotal) }}</span>
									</a>
								</li>
								<li>
									<a href="#">Total
										<span>Rp {{ number_format($subtotal) }}</span>
									</a>
								</li>
							</ul>
                            <ul class="list px-1 py-3">
                                <li class="list-inline-item px-5">
                                    <button type="submit" class="main_btn">Konfirmasi Pesanan</button>
                                </li>
                            </ul>
              </form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Checkout Area =================-->
@endsection
