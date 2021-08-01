@extends('layouts.ecommerce')

@section('title')
<title> {{env('APP_NAME')}}</title>
@endsection

@section('content')
    <!--================Home Banner Area =================-->
	<section class="home_banner_area">
		<div class="overlay"></div>
		<div class="banner_inner d-flex align-items-center">
			<div class="container">
				<div class="banner_content row">
					<div class="offset-lg-2 col-lg-8">
						<h3>Waroeng Jajanan untuk
							<br />Semuanya!</h3>
						<a class="white_bg_btn" href="{{ route('front.product') }}">Jajan Yuk!</a>
						{{-- <a class="white_bg_btn" href="{{ route('front.index') }}">View Collection</a> --}}
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Home Banner Area =================-->

	<!--================Feature Product Area =================-->
	<section class="feature_product_area section_gap">
		<div class="main_box">
			<div class="container-fluid">
				<div class="row">
					<div class="main_title">
						<h2>Produk Terbaru</h2>
						<p>Waroeng Jajanan menjual jajanan yang berkualitas dan pas dikantong semua umat.</p>
					</div>
				</div>
				<div class="row">

          <!-- PERHATIAKAN BAGIAN INI, LOOPING DATA PRODUK -->
          @forelse($products as $row)
					<div class="col col1">
						<div class="f_p_item">
							<div class="f_p_img">
                <!-- KEMUDIAN TAMPILKAN IMAGENYA DARI FOLDER /PUBLIC/STORAGE/PRODUCTS -->
                <img class="img-fluid" src="{{ $row->image }}" alt="{{ $row->slug }}">
                {{-- <img class="img-fluid" src="" alt=""> --}}
								<div class="p_icon">
									<a href="{{ url('/product/' . $row->slug) }}">
									{{-- <a href=""> --}}
										<i class="lnr lnr-cart"></i>
									</a>
								</div>
							</div>
              <!-- KETIKA PRODUK INI DIKLIK MAKA AKAN DIARAHKAN KE URL DIBAWAH -->
              <!-- HANYA SAJA URL TERSEBUT BELUM DISEDIAKAN PADA ARTIKEL KALI INI -->
              <a href="{{ url('/product/' . $row->slug) }}">
              {{-- <a href=""> --}}
                <!-- TAMPILKAN NAMA PRODUK -->
                 <h4>{{ $row->name }}</h4>
                 {{-- <h4></h4> --}}
							</a>
              <!-- TAMPILKAN HARGA PRODUK -->
              <h5>Rp {{ number_format($row->price) }}</h5>
              {{-- <h5>Rp. 0</h5> --}}
						</div>
					</div>
          @empty

          @endforelse
				</div>

        <!-- GENERATE PAGINATION UNTUK MEMBUAT NAVIGASI DATA SELANJUTNYA JIKA ADA -->
				<div class="row">
					{{ $products->links() }}
				</div>
			</div>
		</div>
	</section>
	<!--================End Feature Product Area =================-->

    	<!--================Hot Deals Area =================-->
	<section class="hot_deals_area section_gap">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6">
					<div class="hot_deal_box">
						{{-- <img class="img-fluid" src="{{ asset('ecommerce/img/product/hot_deals/deal1.jpg') }}" alt=""> --}}
						<img class="img-fluid" src="{{ asset('ecommerce/img/product/hot_deals/deal1.jpg') }}" alt="">
						<div class="content">
							<h1>Paling banyak dicari!</h1>
							{{-- <p><a href="{{ route('front.listLoved') }}">shop now</a></p> --}}
                            <h2>Jajan Yuk!</h2>
						</div>
						<a class="hot_deal_link" href="{{ route('front.notfound') }}"></a>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="hot_deal_box">
						<img class="img-fluid" src="{{ asset('ecommerce/img/product/hot_deals/deal1.jpg') }}" alt="">
						<div class="content">
							<h1>Paling banyak dibeli!</h1>
							{{-- <p><a href="{{ route('front.listLoved') }}">shop now</a></p> --}}
                            <h2>Jajan Yuk!</h2>
						</div>
						<a class="hot_deal_link" href="{{ route('front.notfound') }}"></a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Hot Deals Area =================-->
@endsection

@section('js')
    <script>
$(document).ready(function () {
    @if($scroll)
        $('html, body').animate({
            scrollTop: $('#element').offset().top
        }, 'slow');
    @endif
});
</script>
@endsection
