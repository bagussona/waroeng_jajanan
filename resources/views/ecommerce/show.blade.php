@extends('layouts.ecommerce')

@section('title')
    <title>{{ env('APP_NAME') }}</title>
@endsection

@section('content')
    <!--================Home Banner Area =================-->
	<section class="banner_area">
		<div class="banner_inner d-flex align-items-center">
			<div class="container">
				<div class="banner_content text-center">
                    <h2>{{ $products->name}}</h2>
					<div class="page_link">
                        <a href="{{ url('/') }}">Home</a>
                        <a href="#">{{ $products->name }}</a>
                        {{-- <a href="#">[product->name]</a> --}}
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Home Banner Area =================-->

	<div class="product_image_area">
		<div class="container">
			<div class="row s_product_inner">
				<div class="col-lg-6">
					<div class="s_product_img">
						<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="carousel-item active">
									<img class="d-block w-100" src="{{ $products->image }}" alt="{{ $products->name }}">
									{{-- <img class="d-block w-100" src="" alt=""> --}}
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-5 offset-lg-1">
					<div class="s_product_text">
						<h3>{{ $products->name }}</h3>
						{{-- <h3>[product->name]</h3> --}}
                        <h2>Rp {{ number_format($products->price) }}</h2>
                        {{-- <h2>Rp 0 }}</h2> --}}
						<ul class="list">
							<li>
								<a class="active" href="#">
                                    <span>Kategori</span> : {{ $products->category }}</a>
                                    {{-- <span>Kategori</span> : [product->category->name]</a> --}}
							</li>
						</ul>
						<p></p>
						<form action="{{ route('front.cart') }}" method="POST">
							@csrf
						<div class="product_count">
							<label for="qty">Quantity:</label>
							<input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">

							<input type="hidden" name="product_id" value="{{ $products->id }}" class="form-control">
							{{-- <input type="hidden" name="product_id" value="" class="form-control"> --}}

							<button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
							 class="increase items-count" type="button">
								<i class="lnr lnr-chevron-up"></i>
							</button>
							<button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
							 class="reduced items-count" type="button">
								<i class="lnr lnr-chevron-down"></i>
							</button>
						</div>
						<div class="card_area">
							<button class="main_btn">Add to Cart</button>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--================End Single Product Area =================-->

	<!--================Product Description Area =================-->
	<section class="product_description_area">
		<div class="container">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Specification</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Description</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab" style="color: black">


                    {!! $products->description !!}
					{{-- [product->description] --}}


                </div>
				<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
					<div class="table-responsive">
						<table class="table">
							<tbody>
								<tr>
									<td>
										<h5>Stock</h5>
									</td>
									<td>
                                        <h5>{{ $products->stock }} /pcs</h5>
                                        {{-- <h5>[product->stock]</h5> --}}
									</td>
								</tr>
								<tr>
									<td>
										<h5>Harga</h5>
									</td>
									<td>
										<h5>Rp {{ number_format($products->price) }}</h5>
										{{-- <h5>Rp 0</h5> --}}
									</td>
								</tr>
								<tr>
									<td>
										<h5>Kategori</h5>
									</td>
									<td>
										<h5>{{ $products->category }}</h5>
										{{-- <h5>[product->category->name]</h5> --}}
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Product Description Area =================-->
@endsection
