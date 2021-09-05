@extends('layouts.ecommerce')

@section('title')
    <title>{{ env('APP_NAME') }}</title>

    <style>

        .search__container {
            width: 500px;
        }

        .search__title {
            font-size: 22px;
            font-weight: 900;
            text-align: center;
            color: #ff8b88;
        }

        .search__input {
            width: 100%;
            padding: 12px 24px;

            background-color: transparent;
            transition: transform 250ms ease-in-out;
            font-size: 14px;
            line-height: 18px;

            color: #575756;
            background-color: transparent;

            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E%3Cpath d='M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z'/%3E%3Cpath d='M0 0h24v24H0z' fill='none'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-size: 18px 18px;
            background-position: 95% center;
            border-radius: 50px;
            border: 1px solid #575756;
            transition: all 250ms ease-in-out;
            backface-visibility: hidden;
            transform-style: preserve-3d;
        }

        .search__input::placeholder {
            color: rgba(87, 87, 86, 0.8);
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .search__input:hover,
        .search__input:focus {
            padding: 12px 0;
            outline: 0;
            border: 1px solid transparent;
            border-bottom: 1px solid #575756;
            border-radius: 0;
            background-position: 100% center;
        }

    </style>
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
                            <form action="{{ route('front.product') }}" method="get">
                            <div class="search__container">
                                <input name="q" class="search__input" type="text" placeholder="Search">
                            </div>
                            </form>
                        </div>
                        <div class="right_page ml-auto">
                            {{ $products->links() }}
                        </div>
                    </div>
                    <div class="latest_product_inner row">

                      	<!-- PROSES LOOPING DATA PRODUK, SAMA DENGAN CODE YANG ADDA DIHALAMAN HOME -->
                        @forelse ($products as $row)
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="f_p_item">
                                <div class="f_p_img">
                                    <button type="button" class="btn btn-primary" style="position: absolute;" disabled>
                                       <strong> Tersisa: {{ $row->stock }} </strong>
                                    </button>
                                    <img class="img-fluid" src="{{ $row->image }}" alt="{{ $row->name }}">
                                    <div class="p_icon">
                                        <a href="{{ url('/product/' . $row->slug) }}">
                                            <i class="lnr lnr-cart"></i>
                                        </a>
                                    </div>
                                </div>
                                <a href="{{ url('/product/' . $row->slug) }}">
                                <a href="">
                                    <h4>{{ $row->name }}</h4>
                                </a>
                                <h5>Rp {{ number_format($row->price) }}</h5>
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
                                        <strong><a href="{{ url('/category/'.$category->slug) }}">{{ $category->name }}</a></strong>
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
            </div>
        </div>
    </section>
    <!--================End Category Product Area =================-->
@endsection
