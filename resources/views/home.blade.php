<!-- FUNGSI EXTENDS DIGUNAKAN UNTUK ME-LOAD MASTER LAYOUTS YANG ADA, KARENA INI ADALAH HALAMAN HOME MAKA KITA ME-LOAD LAYOUTS ADMIN.BLADE.PHP -->
<!-- KETIKA MELOAD FILE BLADE, MAKA EKSTENSI .BLADE.PHP TIDAK PERLU DITULISKAN -->
@extends('layouts.admin')

<!-- TAG YANG DIAPIT OLEH SECTION('TITLE') AKAN ME-REPLACE (@)YIELD('TITLE') PADA MASTER LAYOUTS -->
@section('title')
    <title>Dashboard - {{ env('APP_NAME') }}</title>
@endsection

<!-- TAG YANG DIAPIT OLEH SECTION('CONTENT') AKAN ME-REPLACE (@)YIELD('CONTENT') PADA MASTER LAYOUTS -->
@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="margin-bottom: 0;" class="card-title">Aktivitas Toko</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="callout callout-info">
                                        <small class="text-muted">Omset Harian</small>
                                        <br>
                                        <strong class="h4">Rp. {{ $omset_daily }}</strong>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="callout callout-danger">
                                        <small class="text-muted">Pelanggan</small>
                                        <br>
                                        <strong class="h4">{{ $registered }}</strong>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="callout callout-primary">
                                        <small class="text-muted">Transaksi Harian</small>
                                        <br>
                                        <strong class="h4">{{ $transaction }} Transaksi</strong>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="callout callout-success">
                                        <small class="text-muted">Total Produk</small>
                                        <br>
                                        <strong class="h4">{{ $product }}</strong>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="callout callout-success">
                                        <small class="text-muted">Total Duit Koperasi</small>
                                        <br>
                                        <strong class="h4">Rp. {{ $duit_koperasi }}</strong>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="callout callout-success">
                                        <small class="text-muted">Modal</small>
                                        <br>
                                        <strong class="h4">Rp. 974000</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Laporan Keuangan Pekanan
                    </div>
                        <div class="card-body">

                        <div class="col-md-12 mb-4">
                            <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#pekan1" role="tab" aria-controls="pekan1">
                                <i class="icon-calculator"></i> Pekan 1
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#pekan2" role="tab" aria-controls="pekan2">
                                <i class="icon-calculator"></i> Pekan 2
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#pekan3" role="tab" aria-controls="pekan3">
                                <i class="icon-calculator"></i> Pekan 3
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#pekan4" role="tab" aria-controls="pekan4">
                                <i class="icon-calculator"></i> Pekan 4
                                </a>
                            </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="pekan1" role="tabpanel">

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="callout callout-info">
                                                    <small class="text-muted">Total Penjualan</small>
                                                    <br>
                                                    <strong class="h4">Rp. 1142000</strong>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="callout callout-danger">
                                                    <small class="text-muted">Keuntungan Didapat</small>
                                                    <br>
                                                    <strong class="h4">Rp. 168000 </strong>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="callout callout-primary">
                                                    <small class="text-muted">Sisa Barang (Rupiah)</small>
                                                    <br>
                                                    <strong class="h4">Rp. 2000</strong>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="callout callout-success">
                                                    <small class="text-muted">Hutang Tersisa</small>
                                                    <br>
                                                    <strong class="h4">0</strong>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="callout callout-success">
                                                    <small class="text-muted">Modal</small>
                                                    <br>
                                                    <strong class="h4">Rp. 974000</strong>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="callout callout-success">
                                                    <small class="text-muted">Pelanggan Daftar</small>
                                                    <br>
                                                    <strong class="h4">31</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane" id="pekan2" role="tabpanel">

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="callout callout-info">
                                                    <small class="text-muted">Total Penjualan</small>
                                                    <br>
                                                    <strong class="h4">Rp. 0</strong>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="callout callout-danger">
                                                    <small class="text-muted">Keuntungan Didapat</small>
                                                    <br>
                                                    <strong class="h4">Rp. 0 </strong>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="callout callout-primary">
                                                    <small class="text-muted">Sisa Barang (Rupiah)</small>
                                                    <br>
                                                    <strong class="h4">Rp. 0</strong>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="callout callout-success">
                                                    <small class="text-muted">Hutang Tersisa</small>
                                                    <br>
                                                    <strong class="h4">Rp. 0</strong>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="callout callout-success">
                                                    <small class="text-muted">Modal</small>
                                                    <br>
                                                    <strong class="h4">Rp. 0</strong>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="callout callout-success">
                                                    <small class="text-muted">Pelanggan Daftar</small>
                                                    <br>
                                                    <strong class="h4">0</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane" id="pekan3" role="tabpanel">

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="callout callout-info">
                                                    <small class="text-muted">Total Penjualan</small>
                                                    <br>
                                                    <strong class="h4">Rp. 0</strong>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="callout callout-danger">
                                                    <small class="text-muted">Keuntungan Didapat</small>
                                                    <br>
                                                    <strong class="h4">Rp.  0 </strong>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="callout callout-primary">
                                                    <small class="text-muted">Sisa Barang (Rupiah)</small>
                                                    <br>
                                                    <strong class="h4">Rp. 0</strong>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="callout callout-success">
                                                    <small class="text-muted">Hutang Tersisa</small>
                                                    <br>
                                                    <strong class="h4">Rp. 0</strong>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="callout callout-success">
                                                    <small class="text-muted">Modal</small>
                                                    <br>
                                                    <strong class="h4">Rp. 0</strong>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="callout callout-success">
                                                    <small class="text-muted">Pelanggan Daftar</small>
                                                    <br>
                                                    <strong class="h4">0</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane" id="pekan4" role="tabpanel">

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="callout callout-info">
                                                    <small class="text-muted">Total Penjualan</small>
                                                    <br>
                                                    <strong class="h4">Rp. 0</strong>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="callout callout-danger">
                                                    <small class="text-muted">Keuntungan Didapat</small>
                                                    <br>
                                                    <strong class="h4">Rp. 0 </strong>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="callout callout-primary">
                                                    <small class="text-muted">Sisa Barang (Rupiah)</small>
                                                    <br>
                                                    <strong class="h4">Rp. 0</strong>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="callout callout-success">
                                                    <small class="text-muted">Hutang Tersisa</small>
                                                    <br>
                                                    <strong class="h4">Rp. 0</strong>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="callout callout-success">
                                                    <small class="text-muted">Modal</small>
                                                    <br>
                                                    <strong class="h4">Rp. 0</strong>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="callout callout-success">
                                                    <small class="text-muted">Pelanggan Daftar</small>
                                                    <br>
                                                    <strong class="h4">0</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="margin-bottom: 0;" class="card-title">Laporan Pembagian Hasil</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="callout callout-success">
                                        <small class="text-muted">Total Keuntungan</small>
                                        <br>
                                        <strong class="h4">Rp. 0</strong>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="callout callout-info">
                                        <small class="text-muted">Pondok</small>
                                        <br>
                                        <strong class="h4">50 %</strong>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="callout callout-danger">
                                        <small class="text-muted">Investor</small>
                                        <br>
                                        <strong class="h4">Rp. 0 x5</strong>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="callout callout-primary">
                                        <small class="text-muted">Gaji Karyawan</small>
                                        <br>
                                        <strong class="h4">Rp. 0 x2</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
