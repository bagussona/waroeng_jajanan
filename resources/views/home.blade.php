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
                            <h4 class="card-title">Aktivitas Toko</h4>
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
                                        <strong class="h4">{{ $duit_koperasi }}</strong>
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
