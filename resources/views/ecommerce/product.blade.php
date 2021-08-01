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
                    <h2>{{ env('APP_NAME') }}</h2>
                    <div class="page_link">
                        <a href="{{ route('front.index') }}">Home</a>
                        <a href="{{ route('front.product') }}">Produk</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Category Product Area =================-->
    <section class="cat_product_area section_gap">
        <div class="container-fluid">
            <div class="row flex-row-reverse">
                <div class="col-lg-9">
                    <div class="product_top_bar">
                        <div class="left_dorp">
                            <select class="sorting">
                                <option value="1">Default sorting</option>
                                <option value="2">Default sorting 01</option>
                                <option value="4">Default sorting 02</option>
                            </select>
                            <select class="show">
                                <option value="1">Show 12</option>
                                <option value="2">Show 14</option>
                                <option value="4">Show 16</option>
                            </select>
                        </div>
                        <div class="right_page ml-auto">
                            Pagination
                            {{-- [pagination] --}}
                        </div>
                    </div>
                    <div class="latest_product_inner row">

                      	<!-- PROSES LOOPING DATA PRODUK, SAMA DENGAN CODE YANG ADDA DIHALAMAN HOME -->
                        @forelse ($products as $row)
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="f_p_item">
                                <div class="f_p_img">
                                    <img class="img-fluid" src="{{ $row->image }}" alt="{{ $row->name }}">
                                    {{-- <img class="img-fluid" src="" alt=""> --}}
                                    <div class="p_icon">
                                        <a href="{{ url('/product/' . $row->slug) }}">
                                        {{-- <a href=""> --}}
                                            <i class="lnr lnr-cart"></i>
                                        </a>
                                    </div>
                                </div>
                                <a href="{{ url('/product/' . $row->slug) }}">
                                <a href="">
                                    <h4>{{ $row->name }}</h4>
                                    {{-- <h4>[row name]</h4> --}}
                                </a>
                                <h5>Rp {{ number_format($row->price) }}</h5>
                                {{-- <h5>Rp 0</h5> --}}
                            </div>
                        </div>
                        @empty

                        <div class="col-md-12">
                            <h3 class="text-center">Tidak ada produk</h3>
                        </div>

                        @endforelse
                      <!-- PROSES LOOPING DATA PRODUK, SAMA DENGAN CODE YANG ADDA DIHALAMAN HOME -->
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="left_sidebar_area">
                        <aside class="left_widgets cat_widgets">
                            <div class="l_w_title">
                                <h3>Kategori Produk</h3>
                            </div>
                            <div class="widgets_inner">
                                <ul class="list">

                                  	<!-- PROSES LOOPING DATA KATEGORI -->
                                    @foreach ($categories as $category)
                                    <li>

                                      	<!-- MODIFIKASI BAGIAN INI -->
                                        <strong><a href="{{ url('/category/' . $category->slug) }}">{{ $category->name }}</a></strong>
\
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>

          	<!-- GENERATE PAGINATION PRODUK -->
            <div class="row">
                {{ $products->links() }}
                {{-- [product->links] --}}
            </div>
        </div>
    </section>
    <!--================End Category Product Area =================-->
@endsection
