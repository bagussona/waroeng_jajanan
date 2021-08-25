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

                            <form action="{{ route('reports.inquiry') }}" method="get">
                                <div class="container-wrapper d-flex flex-row">
                                <div class="header-inquiry d-flex flex-column" style="width: 50%; padding-bottom: 30px; padding-left: 15px;">
                                    <label for="header-name"">Group by</label>
                                    <div class="header-inquiry-name d-flex flex-row">
                                    <label for="inquiry_name" style="margin-left: 15px; margin-right: 15px; margin-bottom: 0; width: 100px; height: 30px; line-height: 30px;">Name:</label>


                                    <select name="inquiry_name" style="width: 526px;">
                                    <option value="">-- All --</option>
                                    @foreach ( $customer_name as $name)
                                        <option value="{{ $name->customer_name }}">{{ $name->customer_name }}</option>
                                    @endforeach
                                    </select>
                                    </div>
                                    <label for="header-date" style="margin-top: 15px;">Periode / Tahun</label>
                                    <div class="header-inquiry-date d-flex flex-row">
                                        <label for="datepickerform" style="margin-left: 15px; margin-right: 15px; margin-bottom: 0; width: 100px; height: 35px; line-height: 35px;">Periode: </label>
                                            <input id="datepickerfrom" name="datepickerfrom" width="250" />
                                        <script>
                                            $('#datepickerfrom').datepicker({
                                                uiLibrary: 'bootstrap4'
                                            });
                                        </script>
                                        <label for="datepickerto" style="margin-left: 5px; margin-right: 5px; margin-bottom: 0; height: 35px; line-height: 35px;">s/d: </label>
                                            <input id="datepickerto" name="datepickerto" width="250" />
                                        <script>
                                            $('#datepickerto').datepicker({
                                                uiLibrary: 'bootstrap4'
                                            });
                                        </script>
                                    </div>
                                </div>
                                <div class="header-inquiry-type d-flex flex-column" style="width: 50%; padding-bottom: 30px; padding-right: 15px;">
                                    <label for="header-name">Inquiry berdasarkan</label>
                                    <div class="header-inquiry-status d-flex flex-row">
                                    <label for="inquiry_status" style="width: 100px; height: 30px; line-height: 30px; margin-left: 15px; margin-right: 15px; margin-bottom: 0;">Status:</label>
                                        <select name="inquiry_status">
                                            <option value="">Status</option>
                                            @foreach ( $status_order as $status )
                                            <option value="{{ $status->status }}">{{ $status->status }}</option>
                                            @endforeach
                                        </select>
                                    <label for="inquiry_type_product" style="margin-left: 150px; margin-right: 15px; margin-bottom: 0; width: 100px; height: 30px; line-height: 30px;">Product:</label>
                                        <select name="inquiry_type_product">
                                            <option value="">All</option>
                                            @foreach ( $product_order as $product )
                                            <option value="{{ $product->name }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label for="inquiry-type-invoice" style="margin-top: 15px;">Faktur Nota</label>
                                    <div class="header-type-invoice d-flex flex-row">
                                        <label for="inquiry_invoice_string" style="width: 100px; height: 30px; line-height: 30px; margin-left: 15px; margin-right: 15px; margin-bottom: 0;">Invoice:</label>
                                        <input type="text" name="inquiry_invoice_string" maxlength="4" style="width: 10%; height: 30px;">
                                        <label for="inquiry_invoice_date" style="height: 30px; line-height: 30px; margin-left: 5px; margin-right: 5px; margin-bottom: 0;">-</label>
                                        <input type="text" name="inquiry_invoice_date" maxlength="10" style="width: 40%; height: 30px;">
                                        <button type="submit" name="inquiry" class="btn btn-primary" style="margin-left: 50px; margin-right: 50px;"><i class="fa fa-search"></i> Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                            <hr style="margin: 30px;">

                            <!-- TABLE UNTUK MENAMPILKAN DATA PRODUK -->
                            <div class="container-wrapper">
                                <div class="header_content_snacks d-flex flex-row">
                                    <div class="header_menu_left" style="width: 40%; height: 50px;">
                                        @foreach ($result as $var)
                                        <div class="customer_invoice d-flex flex-row">
                                            <div class="content d-flex flex-column">
                                                <div class="content-1 d-flex flex-row">
                                                    <label for="invoice" style="width: 75px; margin-bottom: 5px; height: 20px; line-height: 20px;">Invoice</label>
                                                    <label for="invoice" style="width: 25px; margin-bottom: 5px; height: 20px; line-height: 20px; text-align: center;">:</label>
                                                    <span style="margin-bottom: 5px; height: 20px; line-height: 20px;">{{ $var->invoice }}</span>
                                                </div>
                                                <div class="content-2 d-flex flex-row">
                                                    <label for="customer_name" style="width: 75px; margin-bottom: 5px; height: 20px; line-height: 20px;">Pelanggan</label>
                                                    <label for="customer_name" style="width: 25px; margin-bottom: 5px; height: 20px; line-height: 20px; text-align: center;">:</label>
                                                    <span style="margin-bottom: 5px; height: 20px; line-height: 20px;">{{ $var->customer_name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="header_menu_center" style="width: 20%; height: 50px;">
                                        @foreach ($result as $var)
                                        <div class="customer_date">
                                            <div class="content d-flex flex-column">
                                                <div class="content-1 d-flex flex-row">
                                                    <label for="date" style="width: 75px; margin-bottom: 5px; height: 20px; line-height: 20px;">Tanggal</label>
                                                    <label for="date" style="width: 25px; margin-bottom: 5px; height: 20px; line-height: 20px; text-align: center;">:</label>
                                                    <span style="margin-bottom: 5px; height: 20px; line-height: 20px;">{{ date('Y-m-d', strtotime($var->created_at)) }}</span>
                                                </div>
                                                <div class="content-2 d-flex flex-row">
                                                    <label for="receiver" style="width: 75px; margin-bottom: 5px; height: 20px; line-height: 20px;">Periode</label>
                                                    <label for="receiver" style="width: 25px; margin-bottom: 5px; height: 20px; line-height: 20px; text-align: center;">:</label>
                                                    <span style="margin-bottom: 5px; height: 20px; line-height: 20px;">{{ $periode }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="header_menu_right" style="width: 40%; height: 50px;">
                                        @foreach ($result as $var)
                                        <div class="customer_status">
                                            <div class="content d-flex flex-column">
                                                <div class="content-1 d-flex flex-row" style="margin-left: 380px;">
                                                    <label for="status" style="width: 100px; margin-bottom: 5px; height: 20px; line-height: 20px;">Status</label>
                                                    <label for="status" style="width: 25px; margin-bottom: 5px; height: 20px; line-height: 20px; text-align: center;">:</label>
                                                    <span style="margin-bottom: 5px; height: 20px; line-height: 20px;">{{ $var->status }}</span>
                                                </div>
                                                <div class="content-2 d-flex flex-row" style="margin-left: 380px;">
                                                    <label for="payment" style="width: 100px; margin-bottom: 5px; height: 20px; line-height: 20px;">Pembayaran</label>
                                                    <label for="payment" style="width: 25px; margin-bottom: 5px; height: 20px; line-height: 20px; text-align: center;">:</label>
                                                    <span style="margin-bottom: 5px; height: 20px; line-height: 20px;">Tunai/ Non-tunai</span>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <hr style="margin: 2%;">
                                <div class="main-content-snacks d-flex flex-row">
                                    <div class="content-snacks-left" style="width: 50%; height: 240px;">
                                        <div class="content-1" style="background-color: #fffaaf"></div>
                                    </div>
                                    <div class="content-snacks-right" style="width: 50%; height: 240px;">
                                        <div class="content-1" style="background-color: #fffa0f"></div>
                                    </div>
                                </div>
                                <div class="footer-content-snacks">
                                    <div class="footer-content" style="text-align: center;">
                                        <!-- MEMBUAT LINK PAGINASI JIKA ADA -->
                                        {{ $result->links() }}
                                    </div>
                                </div>
                            </div>
                            {{-- {!! $product->links() !!} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
